<?php

use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/news', [MediaController::class, 'index']);
Route::post('/news', [MediaController::class, 'store']);
Route::get('/news/{id}', [MediaController::class, 'show']);
Route::put('/news/{id}', [MediaController::class, 'update']);
Route::delete('/news/{id}', [MediaController::class, 'destroy']);
Route::get('/news/search/{title}', [MediaController::class, 'search']);
Route::get('/news/category/sport', [MediaController::class, 'sport']);
Route::get('/news/category/finance', [MediaController::class, 'finance']);
Route::get('/news/category/automotive', [MediaController::class, 'automotive']);