<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);