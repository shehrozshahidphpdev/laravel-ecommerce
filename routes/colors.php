<?php

use App\Http\Controllers\Admin\ColorController;
use Illuminate\Support\Facades\Route;

Route::resource('colors', ColorController::class);
