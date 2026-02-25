<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TinyMceController;


Route::post('/editor/upload-image', [TinyMceController::class, 'upload']);
