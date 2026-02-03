<?php

use App\Http\Controllers\User\AccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('account/')->name('user.')->group(function () {
    /*
    /  Auth Required Routes
    */
    Route::middleware('CustomerRedirectIfAuthenticated')->group(function () {
        Route::get('register', [AccountController::class, 'register'])
            ->name('account.register');

        Route::get('login', [AccountController::class, 'login'])
            ->name('account.login');

        Route::post('register', [AccountController::class, 'registerUser'])
            ->name('account.register.store');

        Route::post('login', [AccountController::class, 'attemptLogin'])
            ->name('account.attempt-login');
    });

    Route::middleware('auth:customer')->group(function () {
        Route::get('profile', [AccountController::class, 'profile'])
            ->name('account.profile');

        Route::post('information/store', [AccountController::class, 'informationStore'])
            ->name('account.information.store');

        Route::post('logout', [AccountController::class, 'logout'])
            ->name('account.destroy');

        Route::post('profile', [AccountController::class, 'uploadPhoto'])
            ->name('account.upload-photo');

        Route::post('profile/update', [AccountController::class, 'updateProfile'])
            ->name('account.update-profile');

        Route::post('profile/address/update', [AccountController::class, 'updateAddress'])
            ->name('account.address');
    });
});
