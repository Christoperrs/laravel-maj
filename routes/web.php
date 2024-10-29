<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RequestStockController;
use App\Http\Controllers\PreventiveController;
    // web.php
    use App\Http\Controllers\DashController;
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

// Rute yang memerlukan autentikasi
Route::group(['middleware' => ['auth']], function () {

    // Rute resource untuk parts
    Route::resource('parts', PartController::class);

    // Rute untuk mendapatkan data parts berdasarkan product ID
    Route::get('/products/{product}/parts', [ProductController::class, 'getParts'])->name('products.parts');

    // Rute untuk menampilkan detail produk
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Rute untuk bagian maintenance
    Route::resource('maintenances', MaintenanceController::class);
    Route::get('/maintenances/create', [MaintenanceController::class, 'create'])->name('maintenances.create');
    Route::get('/get-part-descriptions/{productId}', [MaintenanceController::class, 'getPartDescriptions']);
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store');
    Route::post('/maintenances/{maintenance}/approve', [MaintenanceController::class, 'approve'])->name('maintenances.approve');
    Route::get('/maintenances/board', [MaintenanceController::class, 'board'])->name('maintenances.board');

    Route::get('/problem', [RepairController::class, 'problem'])->name('repair.create');
    Route::post('/repair', [RepairController::class, 'store'])->name('repair.store');
    Route::get('/repair', [RepairController::class, 'index'])->name('repair.index');
    Route::get('/detail/{id}', [RepairController::class, 'show'])->name('detail_repair');
    Route::get('/repair/{id}/edit', [RepairController::class, 'edit'])->name('repair.edit');
    Route::put('/update/{id}', [RepairController::class, 'update'])->name('repair.update');
    Route::put('/repair/{id}/approveForeman', [RepairController::class, 'approveForeman'])->name('repair.approveForeman');
    Route::put('/repair/{id}/approveSection', [RepairController::class, 'approveSection'])->name('repair.approveSection');


    Route::get('/request-stock', [RequestStockController::class, 'index'])->name('request.stock.index');
    
    Route::resource('request', RequestStockController::class);
    
    Route::post('/request/update', [RequestStockController::class, 'update'])->name('request.update');
    // Route::put('/request/{id}/update', [RequestStockController::class, 'update'])->name('request.update');

    Route::get('/preventive', [PreventiveController::class, 'index'])->name('preventive.index');
    // Route::get('/request-stock', [RequestStockController::class, 'index'])->name('request.stock.index');
    Route::get('/preventive/current-stroke', [PreventiveController::class, 'getCurrentStrokeData']);
    Route::get('/preventive/dark', [PreventiveController::class, 'dark'])->name('preventive.dark');
    Route::delete('/products/detail-picture/{id}', [ProductController::class, 'deleteDetailPicture'])
    ->name('products.detail-picture.destroy');
    



Route::get('/dash/fetchModel', [DashController::class, 'fetchModel'])->name('dash.fetchModel');
// web.php
Route::get('/dies/{model}', [DashController::class, 'showDies'])->name('dies.show');
Route::get('/dash/show/{id}', [DashController::class, 'show'])->name('dash.show');


}); 