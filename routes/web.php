<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompradorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});
// Ruta para mostrar el formulario de login
Route::get('/login', [AdministradorController::class, 'showLogin'])->name('login');

// Ruta para procesar el login (POST)
Route::post('/login', [AdministradorController::class, 'login']);

// Ruta para cerrar sesión
Route::post('/logout', [AdministradorController::class, 'logout'])->name('logout');

// Ruta de bienvenida tras el login
Route::get('/dashboard', [AdministradorController::class, 'dashboard'])->middleware('auth');

Route::get('/views/cambiarContraseña', [AdministradorController::class, 'showChangePasswordForm'])->middleware('auth');

Route::post('/views/cambiarContraseña', [AdministradorController::class, 'cambiarPassword'])->middleware('auth');

Route::get('/crearCategoria', [CategoriaController::class, 'crear'])->name('crearCategoria');

Route::post('/crearCategoria', [CategoriaController::class, 'guardar'])->name('guardarCategoria');

Route::get('/crearProducto', [ProductoController::class, 'crear'])->name('crearProducto');

Route::post('/crearProducto', [ProductoController::class, 'guardar'])->name('guardarProducto');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

Route::post('/productos/editar', [ProductoController::class, 'editar'])->name('productos.editar');

Route::post('/productos/toggle-activado', [ProductoController::class, 'toggleActivado'])->name('productos.toggleActivado');

Route::get('/registroComprador', [CompradorController::class, 'showRegister'])->name('registroComprador');

Route::post('/registroComprador', [CompradorController::class, 'register'])->name('registroComprador.post');

Route::get('/inicio', function () {return view('dashboard.index');})->name('inicio');

Route::view('/login', 'login')->name('login');


