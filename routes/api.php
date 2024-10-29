<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Part;
use App\Models\Product;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PartController;

// Route untuk mengambil data parts
Route::get('/parts', function () {
    return Part::select('id', 'name')->get();
});
Route::get('products/{id}/parts', [ProductController::class, 'getParts']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/{product}/parts', function (Product $product) {
    return $product->parts()->with('detailParts')->get();
});
Route::get('/products/{product}/parts', [PartController::class, 'getPartsByProduct']);
Route::get('products/{id}/parts', [ProductController::class, 'getParts']);
Route::get('parts/{id}/descriptions', [PartController::class, 'getDescriptions']);