<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/ventas', [VentaController::class, 'index']);
Route::get('/detalles_venta', [DetalleVentaController::class, 'index']);
Route::resource('clientes', ClienteController::class)->names('clientes');
Route::resource('usuarios', UsuarioController::class)->names('usuarios');
Route::resource('ventas', VentaController::class)->names('ventas');
Route::resource('detalles_venta', DetalleVentaController::class)->names('detalles_venta');