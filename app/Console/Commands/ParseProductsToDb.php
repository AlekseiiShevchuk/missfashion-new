<?php

namespace App\Console\Commands;

use App\Color;
use App\Donor;
use App\Image;
use App\Product;
use App\Size;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ParseProductsToDb extends Command
{
    const LIMIT_PER_PAGE = 72;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse products and fill db (update old info, and add new products automatic)';

    private $imageManipulator;
    private $imageOptimizer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->imageManipulator = new \PHPixie\Image();
        $this->imageOptimizer = (new \ImageOptimizer\OptimizerFactory())->get();

        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inputProductsUrlArray = [];

        $donors = Donor::all();

        foreach ($donors as $donor) {
            if (!$donor->category) {
                continue;
            }
            $category = $donor->category;
            $productsByCategory = $this->parseProducts($donor);
            if (!is_array($productsByCategory) || count($productsByCategory) < 1) {
                continue;
            }
            foreach ($productsByCategory as $inputProduct) {
                $inputProductsUrlArray[] = $inputProduct['url'];
                /**@var Product $localProduct */
                $localProduct = Product::firstOrNew([
                    'source_url' => $inputProduct['url']
                ]);
                $localProduct->name = '';
                $localProduct->save();
                $localProduct->fresh();

                //разруливаем связи продукта с другими моделями
                $localProduct->category()->associate($category);

                if (is_array($inputProduct['image']) && count($inputProduct['image']) > 0) {
                    foreach ($inputProduct['image'] as $inputImage) {
                        if ($inputImage == null) {
                            continue;
                        }
                        $localImage = Image::firstOrCreate(['url' => $inputImage]);
                        if (empty($localImage->local_big_img) || empty($localImage->local_small_img)) {
                            $this->downloadAndOptimizeImage($localImage);
                        }
                        $localProduct->images()->syncWithoutDetaching([$localImage->id]);
                        $localImage->touch();
                        $localImage->push();
                    }
                }

                if (is_array($inputProduct['colors']) && count($inputProduct['colors']) > 0) {
                    foreach ($inputProduct['colors'] as $inputColor) {
                        if ($inputColor == null) {
                            continue;
                        }
                        $localColor = Color::firstOrCreate(['name' => $inputColor]);
                        $localProduct->colors()->syncWithoutDetaching([$localColor->id]);
                        $localColor->push();
                    }
                }

                if (is_array($inputProduct['str']) && count($inputProduct['str']) > 0) {
                    foreach ($inputProduct['str'] as $inputSize) {
                        if ($inputSize == null) {
                            continue;
                        }
                        $localSize = Size::firstOrCreate(['name' => $inputSize]);
                        $localProduct->sizes()->syncWithoutDetaching([$localSize->id]);
                        $localSize->push();
                    }
                }

                if (is_array($inputProduct['sko_str']) && count($inputProduct['sko_str']) > 0) {
                    foreach ($inputProduct['sko_str'] as $inputSize) {
                        if ($inputSize == null || $inputSize == '') {
                            continue;
                        }
                        $localSize = Size::firstOrCreate(['name' => $inputSize]);
                        $localProduct->sizes()->syncWithoutDetaching([$localSize->id]);
                        $localSize->push();
                    }
                }
                //обновляем/добавляем инфу о продукте
                $localProduct->source_url = $inputProduct['url'];
                $localProduct->name = $inputProduct['name'];
                $localProduct->sku = $inputProduct['sku'];
                $localProduct->old_price = (int)$inputProduct['old_price'];
                $localProduct->new_price = (int)$inputProduct['new_price'];
                $localProduct->regular_price = (int)$inputProduct['regular_price'];
                $localProduct->description = $inputProduct['description'];
                $localProduct->first_accordion_content = $inputProduct['first_accordion_content'];
                $localProduct->second_accordion_content = $inputProduct['second_accordion_content'];
                $localProduct->push();

                if ($localProduct->images()->count() < 1 || strlen($localProduct->name) < 3) {
                    echo 'Images count: ', $localProduct->images()->count(), "\n";
                    echo 'Name length: ', strlen($localProduct->name), "\n";
                    echo 'Deleting ', "\n";
                    $localProduct->delete();
                }

            }
        }
        $this->info('Parser handled ' . count($inputProductsUrlArray) . ' products');

        $this->deleteOldProducts();
    }

    private function parseProducts($donor)
    {
        $client = new Client();

        $responseAmount = $client->request('GET', $donor->url);
        $htmlAmount = $responseAmount->getBody()->getContents();

        $crawlerAmount = new Crawler($htmlAmount);
        if (!$crawlerAmount->filter('div.toolbar-top div.pager > p.amount > label')->count()) {
            return [];
        }
        $amountItem = (int)$crawlerAmount->filter('div.toolbar-top div.pager > p.amount > label')->text();
        $numberPages = ceil($amountItem / self::LIMIT_PER_PAGE);

        $productsList = [];
        for ($currentPage = 1; $currentPage <= $numberPages; $currentPage++) {
            $pageResponse = $client->request('GET', $donor->url, [
                'query' => [
                    'limit' => self::LIMIT_PER_PAGE,
                    'p' => $currentPage
                ]
            ]);

            $htmlProducts = $pageResponse->getBody()->getContents();
            $crawlerProductsList = new Crawler($htmlProducts);
            $productsPerPage = $crawlerProductsList->filter('div.category-products div.item-area h2.product-name a')->each(function (
                Crawler $node
            ) {
                return ['title' => $node->attr('title'), 'href' => $node->attr('href')];
            });
            $productsList = array_merge($productsList, $productsPerPage);
        }

        $product = [];
        if (!is_array($productsList) || count($productsList) < 1) {
            return $product;
        }

        foreach ($productsList as $item) {
            $responseProduct = $client->request('GET', $item['href']);
            $htmlProduct = $responseProduct->getBody()->getContents();

            $crawlerProduct = new Crawler($htmlProduct);
            $productUrl = $item['href'];
            $productBlock = $crawlerProduct->filter('div.product-essential');
            $productName = $productBlock->filter('div.product-name h1')->text();
            $productSku = $productBlock->filter('div.product-sku span.sku')->text();
            $nodeProductOldPrice = $productBlock->filter('div.price-box > p.old-price > span.price');
            if ($nodeProductOldPrice->count()) {
                $productOldPrice = (float)$nodeProductOldPrice->text();
            } else {
                $productOldPrice = '';
            }
            $nodeProductNewPrice = $productBlock->filter('div.price-box > p.special-price > span.price');
            if ($nodeProductNewPrice->count()) {
                $productNewPrice = (float)$nodeProductNewPrice->text();
            } else {
                $productNewPrice = '';
            }
            $nodeProductRegularPrice = $productBlock->filter('div.price-box > span.regular-price > span.price');
            if ($nodeProductRegularPrice->count()) {
                $productRegularPrice = (float)$nodeProductRegularPrice->text();
            } else {
                $productRegularPrice = '';
            }
            if ($productBlock->filter('label#color_label')->count()) {
                $colors = $productBlock->filter('dd > div.input-box span.swatch-label img')->each(function (
                    Crawler $node
                ) {
                    return basename($node->attr('src'), '.png');
                });
            } else {
                $colors = [];
            }
            if ($productBlock->filter('label#size_label')->count()) {
                $productStr = $productBlock->filter('dd > div.input-box span.swatch-label')->each(function (
                    Crawler $node
                ) {
                    if (!empty(trim($node->text()))) {
                        return trim($node->text());
                    }
                });
            } else {
                $productStr = '';
            }
            if ($productBlock->filter('label#shoesize_label')->count()) {
                $productSkoStr = $productBlock->filter('dd > div.input-box span.swatch-label')->each(function (
                    Crawler $node
                ) {
                    if (!empty(trim($node->text()))) {
                        return trim($node->text());
                    }
                });
            } else {
                $productSkoStr = '';
            }

            $productDescription = trim($productBlock->filter('div.extra-product-information > div.short-description > div')->text());
            $productFirstAccordionContent = trim($productBlock->filter('div.extra-product-information > div#accordion-container > div.accordion-content')->first()->html());
            $productSecondAccordionContent = trim($productBlock->filter('div.extra-product-information > div#accordion-container > div.accordion-content')->last()->html());
            $productImage = $productBlock->filter('div.product-img-box img.etalage_thumb_image')->each(function (
                Crawler $node
            ) {
                return $node->attr('src');
            });

            $product[] = [
                'url' => $productUrl,
                'name' => $productName,
                'sku' => $productSku,
                'old_price' => $productOldPrice,
                'new_price' => $productNewPrice,
                'regular_price' => $productRegularPrice,
                'colors' => $colors,
                'str' => $productStr,
                'sko_str' => $productSkoStr,
                'description' => $productDescription,
                'first_accordion_content' => $productFirstAccordionContent,
                'second_accordion_content' => $productSecondAccordionContent,
                'image' => $productImage
            ];
            /// DELETE THIS after testing
            // return $product;
        }

        return $product;
    }

    private function downloadAndOptimizeImage(Image $image)
    {
        $response_code = get_headers($image->url)[0];
        if (!strstr($response_code, '200 OK')) {
            return;
        };
        try {
            //make big image from url
            $localImgFile = $this->imageManipulator->load(file_get_contents($image->url));
            $localImgFile->resize(null, 800);
            $dbPath = 'uploads/' . microtime(true) . '.jpg';
            $fullPath = public_path($dbPath);
            $localImgFile->save($fullPath, 'jpg');
            $this->imageOptimizer->optimize($fullPath);
            $image->local_big_img = $dbPath;

            //make small image from big image
            $localImgFile = $this->imageManipulator->read($fullPath);
            $localImgFile->resize(null, 300);
            $dbPath = 'uploads/' . microtime(true) . '_small.jpg';
            $fullPath = public_path($dbPath);
            $localImgFile->save($fullPath, 'jpg');
            $this->imageOptimizer->optimize($fullPath);
            $image->local_small_img = $dbPath;
        } catch (Exception $e) {
            echo 'Поймано исключение: ', $e->getMessage(), "\n";
        }
    }

    private function deleteOldProducts()
    {
        $twoDaysAgo = Carbon::now()->subDay(2);
        $allProducts = Product::where('updated_at', '<', $twoDaysAgo)->get();
        $numberOfDeletedProducts = count($allProducts);
        foreach ($allProducts as $oldProduct) {
            $oldProduct->delete();
        }

        $this->info('Deleted ' . $numberOfDeletedProducts . ' old products');
    }
}
