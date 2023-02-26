<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');

Route::get('/subcategorias/{id}', [App\Http\Controllers\CategoriaController::class, 'getSubCategorias'])->name('subcategorias');
Route::post('/store-product', [\App\Http\Controllers\ProductoController::class, 'store'])->name('store-product');
Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos-list');
Route::get('/productos/edit/{id}', [App\Http\Controllers\ProductoController::class, 'edit'])->name('producto-edit');
Route::post('/productos/update/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('producto-update');
Route::delete('/productos/delete/{id}', [App\Http\Controllers\ProductoController::class, 'delete'])->name('producto-delete');