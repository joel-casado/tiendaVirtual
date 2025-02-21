<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // ✅ Importar el modelo

class ProductoController extends Controller
{
    // Mostrar el formulario para crear productos
    public function crear()
    {
        return view('crearProducto'); // ✅ Asegurar que la vista existe en resources/views
    }

    // Guardar el producto en la base de datos
    public function guardar(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        // Guardar en la base de datos
        Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/crearProducto')->with('success', 'Producto creado correctamente.');
    }
}
