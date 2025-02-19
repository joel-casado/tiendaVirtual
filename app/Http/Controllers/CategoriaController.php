<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function crear()
    {
        return view('crearCategoria'); // Asegúrate de que esta vista existe en resources/views
    }
    public function guardar(Request $request)
    {

        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
        ]);

        Categoria::create(['nombre_categoria' => $request->nombre_categoria,
        'codigo_categoria' => strtoupper(substr($request->nombre_categoria, 0, 3)) . rand(100, 999), // ✅ Genera código automático
        ]);

        return redirect('/crearCategoria')->with('success', 'Categoría creada correctamente.');
    }
}
