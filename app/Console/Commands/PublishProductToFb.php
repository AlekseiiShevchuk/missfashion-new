<?php

namespace App\Console\Commands;

use App\Product;
use Facebook\Facebook;
use Illuminate\Console\Command;

class PublishProductToFb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb_publish:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish random product to FB';

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
        // App ID и App Secret из настроек приложения
        $app_id = env('FB_APP_ID');
        $app_secret = env('FB_APP_SECRET');
        // ID страницы и токен
        $page_id = env('FB_PAGE_ID');
        $token = env('FB_PAGE_TOKEN');
        $fb = new Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.8',
        ]);
        $product = Product::where('old_price', '>', 1)->get()->random(1);

        $linkData = [
            'link' => route('front.product.show', ['id' => $product->id]),
            //'message' => $product->description,
            'content' => 'some content',
        ];

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post("/{$page_id}/feed", $linkData, $token);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();

        echo 'Posted with id: ' . $graphNode['id'];
    }
}
