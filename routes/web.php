<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;



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

Route::get('/',[AppController::class,'index'])->name('app.index');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');

Route::get('/product/{slug}',[ShopController::class,'productDetails'])->name('shop.product.details');

Route::get('/cart-wishlist-count',[ShopController::class,'getCartAndWishlistCount'])->name('shop.cart.wishlist.count');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');

Route::post('/cart/store',[CartController::class,'addToCart'])->name('cart.store');

Route::put('/cart/update',[CartController::class,'updateCart'])->name('cart.update');

Route::delete('/cart/remove',[CartController::class,'removeItem'])->name('cart.remove');

Route::delete('/cart/clear',[CartController::class,'clearCart'])->name('cart.clear');

Route::get('/wishlist', [WishlistController::class, 'getWishlistedProducts'])->name('wishlist.list');

Route::post('/wishlist/add', [WishlistController::class, 'addToProductWishlist'])->name('wishlist.store');

Route::delete('/wishlist/remove',[WishlistController::class,'removeProductFromWishlist'])->name('wishlist.remove');

Route::delete('/wishlist/clear',[WishlistController::class,'clearWishlist'])->name('wishlist.clear');

Route::post('/wishlist/move-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.to.cart');

Route::get('/checkout',[CheckoutController::class,'checkout'])->name('shop.checkout');





Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/my-account',[UserController::class,'index'])->name('user.index');
});

Route::middleware(['auth','auth-admin'])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
});

Route::get('/home', [App\Http\Controllers\AppController::class, 'index'])->name('home');


//admin dashboard

//  Route::prefix('/admin')->group(function(){
//     Route::get('dashboard', [AdminPageController::class, 'dashboard']);
// });

// Route::get('/adminlogin',[AdminPageController::class,'index'])->name('admin.adminlogin');
Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login',[AdminPageController::class,'index'])->name('admin.adminlogin');
        Route::post('/authenticate',[AdminPageController::class,'authenticate'])->name('admin.authenticate');

    });
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard',[AdminHomeController::class,'index'])->name('admin.admindashboard');
        Route::get('/logout',[AdminHomeController::class,'logout'])->name('admin.logout');
        //product routes

        Route::get('/products/create',[AdminProductController::class,'create'])->name('products.create');

        // Route::get('/get-slug', [AdminProductController::class, 'getSlug'])->name('getSlug');


    });

});


