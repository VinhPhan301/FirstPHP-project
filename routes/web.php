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
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckLogin;




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


Route::prefix('user')->group(function () {
   Route::get('/list',[UserController::class, 'index'])->name('user.list')->middleware('checkRole');

   Route::get('/create', [UserController::class, 'getViewCreate'])->name('user.create')->middleware('checkRole');
   Route::post('/create', [UserController::class, 'create'])->middleware('checkRole');
   
   Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

   Route::get('/update/{id}', [UserController::class, 'getViewUpdate'])->name('user.update');
   Route::post('/update/{id}', [UserController::class, 'update']);

   Route::get('/login', [UserController::class, 'getViewLogin'])->name('user.login');
   Route::post('/login', [UserController::class, 'postLogin'])->name('user.login');

   Route::get('/logout', [UserController::class, 'getLogout'])->name('user.logout');

   Route::get('/page', [UserController::class, 'getViewPage'])->name('user.viewpage')->middleware('checkRole');

   Route::get('/test', [UserController::class, 'getViewTest'])->name('user.test')->middleware('checkRole');
});


Route::prefix('category')->group(function (){
   Route::get('/list', [CategoryController::class, 'index'])->name('category.list')->middleware('checkRole');

   Route::get('/create', [CategoryController::class, 'getViewCreate'])->name('category.create')->middleware('checkRole');
   Route::post('/create', [CategoryController::class, 'create'])->middleware('checkRole');

   Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

   Route::get('/update/{id}', [CategoryController::class, 'getViewUpdate'])->name('category.update');
   Route::post('/update/{id}', [CategoryController::class, 'update']);
});


Route::prefix('product')->group(function (){
   Route::get('/list', [ProductController::class, 'index'])->name('product.list')->middleware('checkRole');

   Route::get('/create', [ProductController::class, 'getViewCreate'])->name('product.create')->middleware('checkRole');
   Route::post('/create', [ProductController::class, 'create'])->middleware('checkRole');

   Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->where('id', '[0-9]+');

   Route::get('/update/{id}', [ProductController::class, 'getViewUpdate'])->name('product.update')->where('id', '[0-9]+');
   Route::post('/update/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
});


Route::prefix('productDetail')->group(function (){
   Route::get('/list/{id}', [ProductDetailController::class, 'index'])->name('productDetail.list')->middleware('checkRole');

   Route::get('/create/{id}', [ProductDetailController::class, 'getViewCreate'])->name('productDetail.create')->middleware('checkRole');
   Route::post('/create/{id}', [ProductDetailController::class, 'create'])->middleware('checkRole');

   Route::get('/delete/{id}', [ProductDetailController::class, 'delete'])->name('productDetail.delete');

   Route::get('/update/{id}', [ProductDetailController::class, 'getViewUpdate'])->name('productDetail.update');
   Route::post('/update/{id}', [ProductDetailController::class, 'update']);
});


Route::prefix('shop')->group(function () {
   Route::get('/',[ShopController::class, 'getView'])->name('shop.view');

   Route::get('/view', [ShopController::class, 'getView'])->name('shop.view');

   Route::get('/viewcate', [ShopController::class, 'getViewCategory'])->name('shop.viewcate');

   Route::get('/findProduct', [ShopController::class, 'findProduct'])->name('shop.findProduct');

   Route::get('/product', [ShopController::class, 'getViewProduct'])->name('shop.product');

   Route::get('/signup', [ShopController::class, 'getViewCreate'])->name('shop.signup');

   Route::post('/signup', [ShopController::class, 'createAccount']);

   Route::get('/login', [ShopController::class, 'getViewLogin'])->name('shop.login');

   Route::post('/login', [ShopController::class, 'postLogin'])->name('shop.login');

   Route::get('/logout', [ShopController::class, 'getLogout'])->name('shop.logout');

   Route::get('/user/{id}', [ShopController::class, 'getViewUser'])->name('shop.user');
   Route::post('/user/{id}', [ShopController::class, 'update']);

   Route::get('/checkout', [ShopController::class, 'getViewCheckout'])->name('shop.checkout');
   Route::post('/checkout', [OrderController::class, 'createOrder']);

});


Route::prefix('cartItem')->group(function () {
   Route::get('/',[CartItemController::class, 'getViewCart'])->name('cartItem.view');

   Route::get('/create', [CartItemController::class, 'create'])->name('cartItem.create')->middleware('checkLogin');

   Route::get('/delete', [CartItemController::class, 'delete'])->name('cartItem.delete')->middleware('checkLogin');

   Route::get('/update', [CartItemController::class, 'update'])->name('cartItem.update')->middleware('checkLogin');

});

Route::prefix('cart')->group(function () {
   Route::get('/', [CartController::class, 'getViewCart'])->name('cart.view')->middleware('checkLogin');

   Route::get('/create', [CartController::class, 'createCart'])->name('cart.create');

   Route::get('/storage', [CartController::class, 'getStorage'])->name('cart.getStorage');
});
