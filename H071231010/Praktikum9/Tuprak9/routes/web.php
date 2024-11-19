<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\inventoryLogController;



Route::resource('products', productController::class);
Route::resource('categories', categoryController::class);
Route::resource('inventory_logs', inventoryLogController::class)->only(['index', 'store', 'destroy']);
Route::get('/', [productController::class,'index'])->name('products.index');
Route::get('inventory-logs',[inventoryLogController::class,'index'])->name('inventory_logs.index');
Route::get('/inventory_logs/create',[inventoryLogController::class, 'create'])->name('inventory_logs.create');

Route::post('/inventory_logs',[inventoryLogController::class, 'store'])->name('inventory_logs.store');
