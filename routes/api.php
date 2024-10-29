<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    CurrencyController,
    AuthController,
    CurrencyConverterController
};

// Authentication Routes
Route::middleware('throttle:60,1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

// Currency Conversion Route
Route::post('/convert', [CurrencyConverterController::class, 'convert'])->name('currencies.convert');

// Currency Management Routes
Route::prefix('currencies')->controller(CurrencyController::class)->group(function () {
    Route::get('/', 'index')->name('currencies.index');

    // Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', 'store')->name('currencies.store');
        Route::get('/{id}', 'show')->name('currencies.show');
        Route::put('/{id}', 'update')->name('currencies.update');
        Route::delete('/{id}', 'destroy')->name('currencies.destroy');
        Route::get('/search', 'search')->name('currencies.search');
    // });
});
