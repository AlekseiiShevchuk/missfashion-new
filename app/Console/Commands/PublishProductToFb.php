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
        $app_id = "1189852821128418";
        $app_secret = "e4fd58bfef782178211d4c80133a0dad";
        // ID страницы и токен
        $page_id = "1249065695166420";
        $token = "EAAQ6KjK9BOIBAGw9xH5cY3N6C8nl320DPqSC5ZCedbUp37mgKQuWmWkF8y9s0VAjZAW5bPb9s5e2FiGy9YTgp4swScgiOgeQEXXtBHblchrIWPcwwWJvZA70ZBP9LY8ydoQEukAQ7Vv388USEgY08j3e8uLs4ZALo3tXdU9OeXAZDZD";
        $fb = new Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.8',
        ]);
        $product = Product::all()->random(1);

        $linkData = [
            'link' => route('products.show', ['id' => $product->id]),
            'message' => $product->description,
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
