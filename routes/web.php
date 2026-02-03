<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('user.index');
})->name('user.home');

require __DIR__ . '/auth.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/user-accounts.php';

Route::middleware('auth')->group(function () {
    require __DIR__ . '/admin.php';
});

Route::get('demo', [TestController::class, 'demo']);


Route::fallback(function () {
    echo "<h1>Sorry Page not found.... </h1>";
});
