<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->group(function() {

    // Ürünler
    Route::apiResource('products', ProductController::class);

    // Kategoriler
    Route::apiResource('categories', CategoryController::class);

    // Delete operations (removed admin middleware for now)
    // Route::delete('products/{product}', [ProductController::class,'destroy'])->middleware('ensure.admin');
    // Route::delete('categories/{category}', [CategoryController::class,'destroy'])->middleware('ensure.admin');

    // Logout
    Route::post('logout', [AuthController::class,'logout'])->name('logout');

});
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login'])->name('login');

