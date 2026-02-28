<?php

use App\Http\Controllers\Admin\ProductSpecificaitonController;
use Illuminate\Support\Facades\Route;

Route::resource('product-specifications', (ProductSpecificaitonController::class));
