<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompradorController;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

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

Route::get('/', function () {$categorias = Categoria::with('productos')->get();return view('dashboard.index', compact('categorias'));});

Route::view('/login', 'login')->name('login');

Route::post('/carrito/agregar', function (Request $request) {
    $producto = Producto::findOrFail($request->producto_id);

    $carrito = session()->get('carrito', []);

    if (isset($carrito[$producto->id])) {
        $carrito[$producto->id]['cantidad']++;
    } else {
        $carrito[$producto->id] = [
            'nombre' => $producto->nombre_producto,
            'precio' => $producto->precio,
            'cantidad' => 1,
        ];
    }

    session(['carrito' => $carrito]);

    return redirect('/')->with('success', 'Producto añadido al carrito');
})->name('carrito.agregar');

Route::get('/carrito', function () {$carrito = session('carrito', []);return view('carrito', compact('carrito'));})->name('carrito.ver');

Route::post('/carrito/vaciar', function () {session()->forget('carrito');return redirect('/carrito')->with('success', 'Carrito vaciado correctamente');})->name('carrito.vaciar');




