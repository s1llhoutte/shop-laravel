<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/products', \App\Http\Controllers\API\Product\IndexController::class);
Route::get('/products/filters', \App\Http\Controllers\API\Product\FilterListController::class);
Route::get('/products/{product}', \App\Http\Controllers\API\Product\ShowController::class);
