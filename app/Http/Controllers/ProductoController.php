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
        $request->validate([
            'nombre_producto' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0.01',
            'id_categoria' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        do {
            $codigo = strtoupper(substr($request->nombre_producto, 0, 3)) . rand(100, 999);
        } while (Producto::where('codigo_producto', $codigo)->exists());

        $precio = number_format((float)$request->precio, 2, '.', '');
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time().'_'.$file->getClientOriginalName();
            // Almacena la imagen en "public/productos"
            $imagenPath = $file->storeAs('productos', $filename, 'public');
        }

        try {
            Producto::create([
                'codigo_producto' => $codigo,
                'nombre_producto' => $request->nombre_producto,
                'descripcion' => $request->descripcion,
                'precio' => $precio,
                'id_categoria' => $request->id_categoria,
                'stock' => $request->stock,
                'destacado' => 0,
                'imagen' => $imagenPath, // Guarda la ruta de la imagen (puede ser null si no se subió)
            ]);

            return redirect('/productos')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'No se pudo guardar el producto: ' . $e->getMessage()]);
        }
    }


    public function index()
    {
        // Obtener todos los productos con su categoría (opcional)
        $productos = Producto::with('categoria')->get();
        return view('productos', compact('productos'));
    }
    public function editar(Request $request)
{
    $request->validate([
        'id' => 'required|exists:productos,id',
        'precio' => 'required|numeric|min:0.01',
        'stock' => 'required|integer|min:0',
        'destacado' => 'required|boolean',
    ]);

    $producto = Producto::find($request->id);
    $producto->precio = number_format((float)$request->precio, 2, '.', '');
    $producto->stock = $request->stock;
    $producto->destacado = $request
    $producto->save();

    return response()->json(['mensaje' => 'Producto actualizado correctamente']);
}

}
