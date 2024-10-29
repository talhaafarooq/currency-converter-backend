<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    CurrencyController,
    AuthController
};

// Authentication
Route::middleware('throttle:60,1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);


    // API routes for CurrencyController
    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/currencies', 'getCurrencies')->name('currencies.index');
        Route::post('/convert', 'convert')->name('currencies.convert');
    });


    Route::prefix('currencies')
        ->controller(CurrencyController::class)
        ->middleware('auth:sanctum')
        ->group(function () {
            Route::get('/',  'index');
            Route::post('/',  'store');
            Route::put('/{id}',  'update');
            Route::delete('/{id}',  'destroy');
            Route::get('/search',  'search');
        });
});
