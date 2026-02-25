<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::resource('categories', CategoryController::class);
Route::post('categories/search', [CategoryController::class, 'search'])
  ->name('categories.search');
