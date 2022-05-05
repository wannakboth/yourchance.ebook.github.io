<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\EBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ebook
Route::get('/all-books', [EBookController::class, 'index']);
Route::get('/popular-books', [EBookController::class, 'popularBook']);

//banner
Route::get('/banner', [BannerController::class, 'index']);
