<?php

namespace App\Providers;

use App\Category;
use App\Product;
use App\Content;
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
        view()->composer('front.header', function ($view)
        {
           $view->with('categories', Category::all()->pluck('name', 'id'));
        });

        view()->composer('front.cats', function ($view)
        {
            $view->with('categories', Category::all()->pluck('name', 'id'));
        });

        view()->composer('front.footer', function ($view)
        {
            $view->with('categories', Category::all()->pluck('name', 'id'));
            $view->with('rated_products', Product::take(3)->get());
        });

        view()->composer('front.page-contents', function ($view)
        {
            $view->with('contents', Content::where('is_active', '1')->get());
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
