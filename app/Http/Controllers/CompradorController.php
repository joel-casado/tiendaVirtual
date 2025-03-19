<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Comprador; // Asegúrate de tener este modelo creado

class CompradorController extends Controller
{
    // Mostrar el formulario de registro para compradores
    public function showRegister()
    {
        return view('registroComprador'); // La vista que contendrá el formulario de registro
    }

    // Procesar el registro del comprador
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email'     => 'required|email|unique:compradores,email',
            'password'  => 'required|string|min:4|confirmed', // Requiere un campo password_confirmation
            'telefono'  => 'required|string',
            'nombre'    => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string',
        ]);

        // Crear el comprador, usando Hash para la contraseña
        Comprador::create([
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'telefono'  => $request->telefono,
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
        ]);

        // Redirigir a una página de login para compradores (o donde prefieras)
        return redirect('/loginAdmin')->with('success', 'Cuenta creada correctamente, por favor inicia sesión.');
    }
}
