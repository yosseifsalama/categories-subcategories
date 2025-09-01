<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;


Route::get('/ping', function () {
    return response()->json(['message' => 'API is working']);
});


Route::apiResource('categories', CategoryController::class);


Route::get('subcategories', [SubcategoryController::class, 'index']);           // GET all
Route::post('subcategories', [SubcategoryController::class, 'store']);          // POST create
Route::get('subcategories/{id}', [SubcategoryController::class, 'show']);       // GET single
Route::put('subcategories/{id}', [SubcategoryController::class, 'update']);     // PUT update
Route::delete('subcategories/{id}', [SubcategoryController::class, 'destroy']); // DELETE


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
