<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login' ,[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class,'logout']);
Route::post('/addproduct', [ProductController::class, 'addproduct']);
Route::post('/getproducts', [ProductController::class, 'getproduct']);
Route::get('product/{filename}', function ($filename) {
    $path = storage_path('app/product/' . $filename);

    if (file_exists($path)) {
        return response()->file($path);
    }

    abort(404);
});