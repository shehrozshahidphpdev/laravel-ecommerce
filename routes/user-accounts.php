<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('account/')->name('user.')->group(function () {
    /*
    /  Auth Required Routes
    */
    Route::middleware('CustomerRedirectIfAuthenticated')->controller(AccountController::class)->group(function () {
        Route::get('register',  'register')
            ->name('account.register');

        Route::get('login',  'login')
            ->name('account.login');

        Route::post('register',  'registerUser')
            ->name('account.register.store');

        Route::post('login',  'attemptLogin')
            ->name('account.attempt-login');

        Route::get('recover',  'forgetPassword')
            ->name('account.recover');

        Route::get('recover/mail', [EmailController::class, 'sendRecoverPasswordMail'])
            ->name('account.passwordmail');
    });

    Route::controller(SocialiteController::class)->group(function () {
        Route::get('auth/google', 'googleLogin')
            ->name('auth.google');
        Route::get('auth/google-callback', 'googleAuth')
            ->name('auth.google-callback');
    });


    Route::middleware('auth:customer')->controller(AccountController::class)->group(function () {
        Route::get('profile',  'profile')
            ->name('account.profile');

        Route::post('information/store',  'informationStore')
            ->name('account.information.store');

        Route::post('logout',  'logout')
            ->name('account.destroy');

        Route::post('profile',  'uploadPhoto')
            ->name('account.upload-photo');

        Route::post('profile/update',  'updateProfile')
            ->name('account.update-profile');

        Route::post('profile/address/update',  'updateAddress')
            ->name('account.address');

        Route::post('profile/change-password',  'updatePassword')
            ->name('account.change-password');
    });
});
