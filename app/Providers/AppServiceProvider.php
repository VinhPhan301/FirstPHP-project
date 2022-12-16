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
            \App\Repositories\Product\OrderRepositoryInterface::class,
            \App\Repositories\Product\OrderRepository::class,
            \App\Repositories\Product\OrderItemRepositoryInterface::class,
            \App\Repositories\Product\OrderItemRepository::class,
        );
    }

    public $bindings = [
        \App\Repositories\Product\CategoryRepository::class => \App\Repositories\Product\CategoryRepository::class,
        \App\Repositories\Product\UserRepositoryInterface::class =>  \App\Repositories\Product\UserRepository::class,
        \App\Repositories\Product\ProductRepositoryInterface::class =>  \App\Repositories\Product\ProductRepository::class,
        \App\Repositories\Product\ProductDetailRepositoryInterface::class =>  \App\Repositories\Product\ProductDetailRepository::class,
        \App\Repositories\Product\CartRepositoryInterface::class =>  \App\Repositories\Product\CartRepository::class,
        \App\Repositories\Product\CartItemRepositoryInterface::class =>  \App\Repositories\Product\CartItemRepository::class,
        \App\Repositories\Product\OrderRepositoryInterface::class =>  \App\Repositories\Product\OrderRepository::class,
        \App\Repositories\Product\OrderItemRepositoryInterface::class =>  \App\Repositories\Product\OrderItemRepository::class,
           
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

        view()->composer('*', function($view) {
            $user = auth()->guard('user')->user();
            if(null !== $user) {
                view()->share([
                    'user'=> $user,
                    'id' => $user->id
                ]);
            } else {
                view()->share([
                    'user'=> 'none',
                    'id' => 0
                ]);
            }
            
        });
    }
}
