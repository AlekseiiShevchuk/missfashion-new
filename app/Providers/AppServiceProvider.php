<?php

namespace App\Providers;

use App\Category;
use App\Content;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('front.header', function ($view) {
            $view->with('categories', Category::all());
        });

        view()->composer('front.cats', function ($view) {
            $view->with('categories', Category::all()->pluck('name', 'id'));
        });

        view()->composer('front.footer', function ($view) {
            $view->with('categories', Category::all()->pluck('name', 'id'));
            $view->with('rated_products', Product::take(3)->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
