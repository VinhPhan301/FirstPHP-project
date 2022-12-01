<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Product;
use View;
use Auth;
use Session;

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
            \App\Repositories\Product\CartRepositoryInterface::class,
            \App\Repositories\Product\CartRepository::class,
            \App\Repositories\Product\CartItemRepositoryInterface::class,
            \App\Repositories\Product\CartItemRepository::class,
        );
    }

    public $bindings = [
        \App\Repositories\Product\CategoryRepository::class => \App\Repositories\Product\CategoryRepository::class,
        \App\Repositories\Product\UserRepositoryInterface::class =>  \App\Repositories\Product\UserRepository::class,
        \App\Repositories\Product\ProductRepositoryInterface::class =>  \App\Repositories\Product\ProductRepository::class,
        \App\Repositories\Product\ProductDetailRepositoryInterface::class =>  \App\Repositories\Product\ProductDetailRepository::class,
        \App\Repositories\Product\CartRepositoryInterface::class =>  \App\Repositories\Product\CartRepository::class,
        \App\Repositories\Product\CartItemRepositoryInterface::class =>  \App\Repositories\Product\CartItemRepository::class,
           
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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

        
        // View::share([
        //     'user' => $user
        // ]);

        // $user = view()->composer('*', function ($view) use($auth) { 
        //     dd($auth->user()); 
        // });

        view()->composer('*', function($view) {
            // dd(auth()->guard('user')->user());
            $user = auth()->guard('user')->user();
            view()->share([
                'user'=> $user
            ]);
            // $view->with('user', auth()->user()); // does what you expect
        });
    }
}