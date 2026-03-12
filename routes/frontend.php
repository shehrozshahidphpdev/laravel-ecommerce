<?php

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name(name: 'user.home');

Route::post('products/fetch', [ProductController::class, 'quickView'])
  ->name('product.quickview');

Route::post('proucts/cart', [CartController::class, 'addToCart'])
  ->name('products.mini-cart');

Route::delete('proucts/cart/', [CartController::class, 'deleteFromCart'])
  ->name('products.cart.delete');

Route::get('product/{slug}', [ProductController::class, 'show'])
  ->where('slug', '.*')
  ->name('products.show');

Route::get('collections/{full_slug}', [ProductController::class, 'collections'])
  ->where('full_slug', '.*')
  ->name('products.collections');

Route::get('cart', [CartController::class, 'index'])
  ->name('products.cart');

Route::post('cart/update', [CartController::class, 'update'])
  ->name('cart.update');

Route::get('collections/{slug}', [HomeController::class, 'page'])
  ->name('collecitons');

Route::get('wishlist', [WishlistController::class, 'index'])
  ->name('wishlist');

Route::post('wishlist/store', [WishlistController::class, 'store'])
  ->name('wishlist.store');

Route::delete('wishlist/{id}', [WishlistController::class, 'destroy'])
  ->name('wishlist.destroy');


Route::post('', [CartController::class, 'storeWishListItemToCart'])
  ->name('wishlist.cart');
