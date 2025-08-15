<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Web Routes
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/addproduct', [ProductController::class, 'addproduct']);
Route::get('/getproducts', [ProductController::class, 'getproduct']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/countitems', [ProductController::class, 'getProductCount']);
Route::delete('/deleteproduct/{id}', [ProductController::class, 'deleteproduct']);
Route::put('/updateproduct/{id}', [ProductController::class, 'updateproduct']);

//Client Users routes
Route::post('/user-Register', [\App\Http\Controllers\UserController::class, 'UserRegister']);
