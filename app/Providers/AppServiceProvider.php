<?php

namespace App\Providers;

use App\Category;
use App\Content;
use App\CustomOption;
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

        view()->composer('front.index', function ($view) {
            $view->with('referal_link_prefix', CustomOption::find('referal_link_prefix')->value);
        });

        view()->composer('front.show', function ($view) {
            $view->with('referal_link_prefix', CustomOption::find('referal_link_prefix')->value);
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
