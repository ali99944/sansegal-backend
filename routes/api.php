<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelGirlController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{order_number}', [OrderController::class, 'getOrderByNumber']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

Route::group(['prefix' => 'model-girls'], function () {
    Route::get('/', [ModelGirlController::class, 'index']);
    Route::post('/', [ModelGirlController::class, 'store']);
    Route::put('/{id}', [ModelGirlController::class, 'update']);
    Route::delete('/{id}', [ModelGirlController::class, 'destroy']);
});

