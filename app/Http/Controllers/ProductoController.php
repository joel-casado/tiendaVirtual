<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importar el modelo
use App\Models\Categoria;

class ProductoController extends Controller
{
    // Mostrar el formulario para crear productos
    public function crear()
    {
        $categorias = Categoria::all();
        if ($categorias->isEmpty()) {
            return back()->withErrors(['No hay categorías disponibles.']);
        }
        return view('crearProducto', compact('categorias'));
    }

    // Guardar el producto en la base de datos
    public function guardar(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'nombre_producto' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0.01',
            'id_categoria' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
        ]);

        // Generar un código único para el producto
        do {
            $codigo = strtoupper(substr($request->nombre_producto, 0, 3)) . rand(100, 999);
        } while (Producto::where('codigo_producto', $codigo)->exists());

        // Convertir precio a decimal correctamente
        $precio = number_format((float)$request->precio, 2, '.', '');

        // Intentar guardar el producto y capturar el error si falla
        try {
            Producto::create([
                'codigo_producto' => $codigo,
                'nombre_producto' => $request->nombre_producto,
                'descripcion' => $request->descripcion,
                'precio' => $precio,
                'id_categoria' => $request->id_categoria,
                'stock' => $request->stock,
                'destacado' => 0,
            ]);

            // Redireccionar a la vista de listado de productos (ruta GET /productos)
            return redirect('/productos')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            // Redireccionar de vuelta con mensaje de error si falla
            return redirect()->back()->withErrors(['error' => 'No se pudo guardar el producto: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        // Obtener todos los productos con su categoría (opcional)
        $productos = Producto::with('categoria')->get();
        return view('productos', compact('productos'));
    }
}
