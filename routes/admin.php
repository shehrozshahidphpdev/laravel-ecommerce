<?php

use App\Http\Controllers\admin\DashBoardController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashBoardController::class, 'index'])
    ->name('admin.home');
