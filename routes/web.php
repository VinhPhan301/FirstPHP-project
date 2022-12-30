<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('admin')->group(function () {
    Route::get('/', [UserController::class, 'getViewPage'])->name('user.viewpage')->middleware('checkRole');
    Route::get('/login', [UserController::class, 'getViewLogin'])->name('user.login');
    Route::post('/login', [UserController::class, 'postLogin'])->name('user.login');
    Route::get('/logout', [UserController::class, 'getLogout'])->name('user.logout')->middleware('checkRole');
    Route::get('/test', [UserController::class, 'getViewTest'])->name('user.test')->middleware('checkRole');

    //  USER
    Route::prefix('/user')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('user.list')->middleware('checkRole');
        Route::get('/create', [UserController::class, 'getViewCreate'])->name('user.create')->middleware('checkRole');
        Route::post('/create', [UserController::class, 'create'])->middleware('checkRole');
        Route::get('/delete/{id}', [UserController::class, 'updateStatus'])->name('user.delete')->middleware('checkRole');
        Route::get('/update/{id}', [UserController::class, 'getViewUpdate'])->name('user.update')->middleware('checkRole');
        Route::post('/update/{id}', [UserController::class, 'update'])->middleware('checkRole');
        Route::get('/account/{id}', [UserController::class, 'getUserAccount'])->name('user.account')->middleware('checkRole');
        Route::post('/account/{id}', [UserController::class, 'update'])->middleware('checkRole');
    });

    Route::prefix('category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('category.list')->middleware('checkRole');
        Route::get('/create', [CategoryController::class, 'getViewCreate'])->name('category.create')->middleware('checkRole');
        Route::post('/create', [CategoryController::class, 'create'])->middleware('checkRole');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('checkRole');
        Route::get('/update/{id}', [CategoryController::class, 'getViewUpdate'])->name('category.update')->middleware('checkRole');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->middleware('checkRole');
    });

    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('product.list')->middleware('checkRole');
        Route::get('/create', [ProductController::class, 'getViewCreate'])->name('product.create')->middleware('checkRole');
        Route::post('/create', [ProductController::class, 'create'])->middleware('checkRole');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('checkRole');
        Route::get('/update/{id}', [ProductController::class, 'getViewUpdate'])->name('product.update')->middleware('checkRole');
        Route::post('/update/{id}', [ProductController::class, 'update'])->middleware('checkRole');
    });

    Route::prefix('productDetail')->group(function () {
        Route::get('/list/{id}', [ProductDetailController::class, 'index'])->name('productDetail.list')->middleware('checkRole');
        Route::get('/create/{id}', [ProductDetailController::class, 'getViewCreate'])->name('productDetail.create')->middleware('checkRole');
        Route::post('/create/{id}', [ProductDetailController::class, 'create'])->middleware('checkRole');
        Route::get('/delete/{id}', [ProductDetailController::class, 'delete'])->name('productDetail.delete')->middleware('checkRole');
        Route::get('/update/{id}', [ProductDetailController::class, 'getViewUpdate'])->name('productDetail.update')->middleware('checkRole');
        Route::post('/update/{id}', [ProductDetailController::class, 'update'])->middleware('checkRole');
    });

    Route::prefix('order')->group(function () {
        Route::get('/list', [OrderController::class, 'getViewAdminOrder'])->name('order.list')->middleware('checkRole');
        Route::get('/item/{id}', [OrderController::class,'getViewAdminOrderItem'])->name('order.item')->middleware('checkRole');
        Route::get('/update', [OrderController::class, 'updateCancel'])->name('order.update')->middleware('checkRole');
        Route::get('/update/{id}', [OrderController::class, 'updateDelivering'])->name('order.adminUpdate')->middleware('checkRole');
    });
});


Route::prefix('/')->group(function () {
    Route::get('/', [ShopController::class, 'getView'])->name('shop.view');
    Route::get('/view', [ShopController::class, 'getView'])->name('shop.view');
    Route::get('/viewcate', [ShopController::class, 'getViewCategory'])->name('shop.viewcate');
    Route::get('/findProduct', [ShopController::class, 'findProduct'])->name('shop.findProduct');
    Route::get('/product', [ShopController::class, 'getViewProduct'])->name('shop.product');
    Route::get('/favoriteCreate', [FavoriteController::class, 'createFavorite'])->name('shop.favoriteCreate');
    Route::get('/favoriteDelete', [FavoriteController::class, 'deleteFavorite'])->name('shop.favoriteDelete');
    Route::get('/signup', [ShopController::class, 'getViewCreate'])->name('shop.signup');
    Route::post('/signup', [ShopController::class, 'createAccount']);
    Route::get('/login', [ShopController::class, 'getViewLogin'])->name('shop.login');
    Route::post('/login', [ShopController::class, 'postLogin'])->name('shop.login');
    Route::get('/logout', [ShopController::class, 'getLogout'])->name('shop.logout');

    Route::prefix('user')->group(function () {
        Route::get('/infor{id}', [ShopController::class, 'getViewUser'])->name('shop.userinfor');
        Route::post('/infor{id}', [ShopController::class, 'update']);
        Route::get('/order/{id}', [OrderController::class, 'getViewOrder'])->name('shop.userorder');
        Route::get('/favorite/{id}', [FavoriteController::class, 'getViewFavorite'])->name('shop.userfavorite');

        Route::prefix('cartItem')->group(function () {
            Route::get('/', [CartItemController::class, 'getViewCart'])->name('cartItem.view');
            Route::get('/create', [CartItemController::class, 'create'])->name('cartItem.create');
            Route::get('/delete', [CartItemController::class, 'delete'])->name('cartItem.delete');
            Route::get('/update', [CartItemController::class, 'update'])->name('cartItem.update');
        });
    });
    Route::get('/checkout', [ShopController::class, 'getViewCheckout'])->name('shop.checkout');
    Route::post('/checkout', [OrderController::class, 'createOrder']);
});

Route::prefix('cart')->group(function () {
    Route::get('/create', [CartController::class, 'createCart'])->name('cart.create');
    Route::get('/storage', [CartController::class, 'getStorage'])->name('cart.getStorage');
});
