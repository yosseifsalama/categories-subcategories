<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\UserAuthController;

Route::get('/ping', function () {
    return response()->json(['message' => 'API is working']);
});


Route::apiResource('categories', CategoryController::class);


// Categories & Subcategories (Protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubcategoryController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function () {
    Route::post('register', [AdminAuthController::class, 'register']);
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AdminAuthController::class, 'logout']);
});

Route::prefix('user')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [UserAuthController::class, 'logout']);
});
// User Profile
Route::middleware('auth:sanctum')->get('/user/profile', function (Request $request) {
    return $request->user();
});

// Admin Profile
Route::middleware('auth:sanctum')->get('/admin/profile', function (Request $request) {
    return $request->user();
});