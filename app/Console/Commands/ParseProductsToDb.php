<?php

namespace App\Console\Commands;

use App\Category;
use App\Color;
use App\Image;
use App\Product;
use App\Size;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ParseProductsToDb extends Command
{
    const LIMIT_PER_PAGE = 72;
//    protected $source = [
//        'http://www.envylook.dk/' => ['nyheder'],
//    ];
    protected $source = [
        'http://www.envylook.dk/' => ['nyheder', 'overdele', 'underdele', 'kjoler', 'sko', 'accessories', 'udsalg'],
        'http://online-mode.dk/' => [
            'nyheder',
            'plus-size/kjoler',
            'plus-size/overdele',
            'plus-size/underdele',
            'toj/kjoler/strikkjoler',
            'toj/kjoler/festkjoler',
            'toj/kjoler/aftenkjoler',
            'toj/kjoler/lange-kjoler',
            'toj/overdele/toppe',
            'toj/overdele/bluser',
            'toj/overdele/tunika',
            'toj/overdele/cardigans',
            'toj/overdele/jakker',
            'toj/underdele/leggins',
            'toj/underdele/jeans',
            'toj/underdele/nederdele',
            'toj/underdele/overalls',
            'toj/tilbehor/nylonstromper',
            'toj/tilbehor/badetoj',
            'toj/tilbehor/lingeri-undertoj',
            'sko-stovler/stovle/ankelstovler',
            'sko-stovler/stovle/stovler',
            'sko-stovler/hoje-sko/pumps',
            'sko-stovler/hoje-sko/stiletter',
            'sko-stovler/flade-sko/sandaler',
            'sko-stovler/flade-sko/sneakers',
            'accessories/acc-tilbehor/tasker',
            'accessories/acc-tilbehor/balter',
            'accessories/acc-tilbehor/torklader',
            'accessories/acc-tilbehor/huer-handsker',
            'accessories/acc-tilbehor/solbriller',
            'accessories/smykker/armband',
            'accessories/smykker/halskaeder',
            'udsalg'
        ]
    ];
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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inputProductsUrlArray = [];

        foreach ($this->source as $site => $categories) {

            foreach ($categories as $category) {

                $productsByCategory = $this->parseProducts($site, $category);
                if (count($productsByCategory) < 1) {
                    continue;
                }
                foreach ($productsByCategory as $inputProduct) {
                    $inputProductsUrlArray[] = $inputProduct['url'];
                    /**@var Product $localProduct */
                    $localProduct = Product::firstOrNew([
                        'source_url' => $inputProduct['url']
                    ]);
                    $localProduct->save();
                    $localProduct->fresh();

                    //разруливаем связи продукта с другими моделями
                    $categoryModel = Category::firstOrCreate(['name' => $category]);
                    $localProduct->category()->associate($categoryModel);

                    if (count($inputProduct['image']) > 0) {
                        foreach ($inputProduct['image'] as $inputImage) {
                            if ($inputImage == null) {
                                continue;
                            }
                            $localImage = Image::firstOrCreate(['url' => $inputImage]);
                            $localProduct->images()->syncWithoutDetaching([$localImage->id]);
                            $localImage->push();
                        }
                    }

                    if (count($inputProduct['colors']) > 0) {
                        foreach ($inputProduct['colors'] as $inputColor) {
                            if ($inputColor == null) {
                                continue;
                            }
                            $localColor = Color::firstOrCreate(['name' => $inputColor]);
                            $localProduct->colors()->syncWithoutDetaching([$localColor->id]);
                            $localColor->push();
                        }
                    }

                    if (count($inputProduct['str']) > 0) {
                        foreach ($inputProduct['str'] as $inputSize) {
                            if ($inputSize == null) {
                                continue;
                            }
                            $localSize = Size::firstOrCreate(['name' => $inputSize]);
                            $localProduct->sizes()->syncWithoutDetaching([$localSize->id]);
                            $localSize->push();
                        }
                    }
                    //обновляем/добавляем инфу о продукте
                    $localProduct->from_site_url = $site;
                    $localProduct->source_url = $inputProduct['url'];
                    $localProduct->name = $inputProduct['name'];
                    $localProduct->sku = $inputProduct['sku'];
                    $localProduct->old_price = (int)$inputProduct['old_price'];
                    $localProduct->new_price = (int)$inputProduct['new_price'];
                    $localProduct->regular_price = (int)$inputProduct['regular_price'];
                    $localProduct->sko_str = $inputProduct['sko_str'];
                    $localProduct->description = $inputProduct['description'];
                    $localProduct->first_accordion_content = $inputProduct['first_accordion_content'];
                    $localProduct->second_accordion_content = $inputProduct['second_accordion_content'];
                    $localProduct->push();

                }
            }
        }

    }

    private function parseProducts($site, $category)
    {
        $client = new Client([
            'base_uri' => $site
        ]);

        $responseAmount = $client->request('GET', $category);
        $htmlAmount = $responseAmount->getBody()->getContents();

        $crawlerAmount = new Crawler($htmlAmount);
        if (!$crawlerAmount->filter('div.toolbar-top div.pager > p.amount > label')->count()) {
            return [];
        }
        $amountItem = (int)$crawlerAmount->filter('div.toolbar-top div.pager > p.amount > label')->text();
        $numberPages = ceil($amountItem / self::LIMIT_PER_PAGE);

        $productsList = [];
        for ($currentPage = 1; $currentPage <= $numberPages; $currentPage++) {
            $pageResponse = $client->request('GET', $category, [
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
}
