<?php

use App\Http\Controllers\Admin\SpecificationController;
use Illuminate\Support\Facades\Route;


Route::resource('specifications', (SpecificationController::class));
Route::post('specifications/search', [SpecificationController::class, 'search'])->name('specifications.search');
