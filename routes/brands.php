<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;

Route::resource('brands', (BrandController::class));
