<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailsController;
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
Route::post('/user-Register', [UserController::class, 'UserRegister']);
Route::post('/user-Login', [UserController::class, 'userLogin']);
Route::post('/user-Logout', [UserController::class, 'userLogout'])->middleware('auth:sanctum');

//Active Dashboard

Route::post('/product/store', [OrderController::class, 'StoreProduct']);
Route::post('/StoreProduct', [OrderController::class, 'StoreProduct']);
Route::get('/orderProduct/{id}', [OrderController::class, 'orderShow']);
Route::get('/getOrder', [OrderController::class, 'getOrderProduct']);
Route::get('/count', [OrderController::class, 'getCount']);

//User Account management
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/details', [UserDetailsController::class, 'getUserDetails']);
    Route::put('/user/updateDetails', [UserDetailsController::class, 'updateUserDetails']);
});
// Cart Controlling

// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::put('/cart/update/{productId}', [CartController::class, 'updateQuantity']);
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart']);
    Route::delete('/cart/clear', [CartController::class, 'clearCart']);
});
