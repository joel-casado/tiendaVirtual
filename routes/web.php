<?php

use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/loginAdmin');
});
// Ruta para mostrar el formulario de login
Route::get('/loginAdmin', [AdministradorController::class, 'showLogin'])->name('login');

// Ruta para procesar el login (POST)
Route::post('/loginAdmin', [AdministradorController::class, 'login']);

// Ruta para cerrar sesión
Route::post('/logout', [AdministradorController::class, 'logout'])->name('logout');

// Ruta de bienvenida tras el login
Route::get('/dashboard', [AdministradorController::class, 'dashboard'])->middleware('auth');

