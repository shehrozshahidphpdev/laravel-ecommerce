<?php

use App\Http\Controllers\admin\DashBoardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/')->group(function () {
    Route::get('', [DashBoardController::class, 'index'])
        ->name('admin.home');
});
