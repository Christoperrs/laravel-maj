<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MaintenancePartController;
use App\Models\Product;
// Rute untuk otentikasi
Auth::routes();

// Rute untuk halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk halaman home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute resource untuk roles, users, dan products
Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);

// Rute untuk bagian produk dengan middleware izin
Route::group(['middleware' => ['auth']], function () {
    Route::resource('products.parts', PartController::class);
    Route::resource('maintenance', MaintenancePartController::class);
    Route::get('api/products/{id}/parts', [ProductController::class, 'getParts']);
    
    // API untuk mengambil part berdasarkan product_id
    // Route::get('/products/{id}/parts', function ($id) {
    //     $product = Product::with('parts')->findOrFail($id);
    //     return response()->json($product->parts);
    // });
});
