<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Product;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Product\CategoryRepositoryInterface::class,
            \App\Repositories\Product\CategoryRepository::class,
            \App\Repositories\Product\UserRepositoryInterface::class,
            \App\Repositories\Product\UserRepository::class,
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\ProductDetailRepositoryInterface::class,
            \App\Repositories\Product\ProductDetailRepository::class,
        );
    }

    public $bindings = [
        \App\Repositories\Product\CategoryRepository::class => \App\Repositories\Product\CategoryRepository::class,
        \App\Repositories\Product\UserRepositoryInterface::class =>  \App\Repositories\Product\UserRepository::class,
        \App\Repositories\Product\ProductRepositoryInterface::class =>  \App\Repositories\Product\ProductRepository::class,
        \App\Repositories\Product\ProductDetailRepositoryInterface::class =>  \App\Repositories\Product\ProductDetailRepository::class,
           
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Lay category de share cho all View// 
        $category = Category::all();  
        View::share([
            'category' => $category,
        ]);

        $product = Product::all();
        $arr = [];
        foreach ($product as $item) {
            $arr[] = $item->type;
        }
        $arrunique = array_unique($arr);
        View::share([
            'productType' => $arrunique,
        ]);
        View::share([
            'product' => $product
        ]);




        // Share cho view chi dinh // 
        // view()->composer(['product.list', 'product.create','ViewPage.viewhome','ViewPage.viewpage'], function($view){
        //     $category = Category::all(); 
        //         view()->share([
        //             'category' => $category,
        //         ]);
        // });

        // view()->composer('ViewPage.viewhome', function(){
        //     $category = Category::all(); dd($category);
        //         view()->share([
        //             'category' => $category,
        //         ]);
        // });
    }
}
