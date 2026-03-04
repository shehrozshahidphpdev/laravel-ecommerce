<?php

use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\User\ProductController as UserProductController;



Route::resource('products', (ProductController::class));

Route::post('products/search', [ProductController::class, 'search'])->name('products.search');

Route::post('products/fetch', [UserProductController::class, 'quickView'])->name('products.quickview');
