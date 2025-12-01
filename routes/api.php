<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Simple test route
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working!',
        'timestamp' => now()
    ]);
});

// Products API Routes
Route::get('/be-products', [ProductController::class, 'index']);
Route::post('/be-products', [ProductController::class, 'store']);
Route::get('/be-products/{id}', [ProductController::class, 'show']);
Route::put('/be-products/{id}', [ProductController::class, 'update']);
Route::delete('/be-products/{id}', [ProductController::class, 'destroy']);

// Fallback for undefined API routes
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'API route not found'
    ], 404);
});