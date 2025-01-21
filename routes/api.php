<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductPriceController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::apiResource('products', ProductController::class);

    Route::prefix('products/{product}')->group(function () {
        Route::get('prices', [ProductPriceController::class, 'index']); 
        Route::post('prices', [ProductPriceController::class, 'store']); 
    });
    
});



