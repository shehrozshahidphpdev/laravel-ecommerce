<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;



require __DIR__ . '/frontend.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/user-accounts.php';

Route::prefix('admin/')->middleware('auth')->group(function () {
    require __DIR__ . '/admin.php';
    require __DIR__ . '/categories.php';
});

Route::get('demo', [TestController::class, 'demo']);

Route::fallback(function () {
    echo "<h1>Sorry Page not found.... </h1>";
});
