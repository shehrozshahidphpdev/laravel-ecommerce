<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name(name: 'user.home');

Route::post('products/fetch', [ProductController::class, 'quickView'])->name('products.quickview');
