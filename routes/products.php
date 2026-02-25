<?php

use Illuminate\Support\Facades\Route;

use  App\Http\Controllers\Admin\ProductController;


Route::resource('products', (ProductController::class));
