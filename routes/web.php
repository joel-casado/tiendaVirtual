<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompradorController;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

Route::get('/', function () {$categorias = Categoria::all();return view('dashboard.index', compact('categorias'));});

Route::get('/categoria/{id}', function ($id) {$categorias = Categoria::all();$categoriaSeleccionada = Categoria::with('productos')->findOrFail($id);
    return view('dashboard.index', compact('categorias', 'categoriaSeleccionada'));
})->name('categoria.ver');

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

Route::get('/pago', function () {return view('pago');});

Route::post('/carrito/confirmar', function () {
    $comprador = session('comprador');
    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect('/carrito')->withErrors(['error' => 'Tu carrito está vacío']);
    }

    // 👇 Redirigir si no está logueado
    if (!$comprador) {
        return redirect('/registroComprador')->withErrors([
        ]);
    }

    DB::beginTransaction();

    try {
        $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        $compra = Compra::create([
            'id_comprador' => $comprador->id,
            'precio_total' => $total,
            'estado' => 'pendiente',
            'fecha_compra' => Carbon::now(),
            'fecha_envio' => null,
        ]);

        foreach ($carrito as $productoId => $item) {
            DetalleCompra::create([
                'id_compra' => $compra->id,
                'id_producto' => $productoId,
                'cantidad' => $item['cantidad'],
                'precio_producto' => $item['precio'],
            ]);
        }

        DB::commit();
        session()->forget('carrito');

        return redirect('/pago')->with('success', 'Pedido confirmado. Procede al pago.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('ERROR AL CONFIRMAR PEDIDO: ' . $e->getMessage()); // 🪵
        return redirect('/carrito')->withErrors(['error' => 'Error al confirmar el pedido: ' . $e->getMessage()]);
    }
})->name('carrito.confirmar');

Route::post('/pagar', function () {
    // Aquí puedes simular que se procesa el pago y se actualiza el estado de la última compra
    $comprador = session('comprador');

    // Obtener la última compra pendiente de este comprador
    $compra = \App\Models\Compra::where('id_comprador', $comprador->id)
        ->where('estado', 'pendiente')
        ->latest('fecha_compra')
        ->first();

    if ($compra) {
        $compra->estado = 'pagado';
        $compra->fecha_envio = now(); // Puedes ajustar esto según lo que signifique para ti
        $compra->save();

        return redirect('/')->with('success', 'Pago realizado con éxito. Gracias por tu pedido.');
    }

    return redirect('/pago')->withErrors(['error' => 'No se encontró un pedido pendiente.']);
})->name('pago.procesar');

Route::get('/mis-pedidos', function () {
    $comprador = session('comprador');

    if (!$comprador) {
        return redirect('/login')->withErrors(['error' => 'Debes iniciar sesión']);
    }

    // Obtener las compras con los productos asociados
    $compras = Compra::where('id_comprador', $comprador->id)
        ->orderByDesc('fecha_compra')
        ->with('detalles.producto') // Asumiendo relaciones definidas
        ->get();

    return view('pedidos', compact('comprador', 'compras'));
})->name('pedidos');
Route::get('/pedido/{id}/pdf', function ($id) {
    $comprador = session('comprador');

    // Seguridad: comprobar que el comprador está logueado
    if (!$comprador) {
        return redirect('/login')->withErrors(['error' => 'Debes iniciar sesión.']);
    }

    // Buscar el pedido solo si pertenece al comprador autenticado
    $compra = Compra::where('id', $id)
        ->where('id_comprador', $comprador->id)
        ->with('detalles.producto')
        ->firstOrFail();

    // Generar el PDF usando una vista Blade
    $pdf = Pdf::loadView('pedido_pdf', compact('compra', 'comprador'));

    return $pdf->download("pedido-{$compra->id}.pdf");
})->name('pedido.pdf');

