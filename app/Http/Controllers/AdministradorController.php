<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    // Mostrar el formulario de login
    public function showLogin()
    {
        return view('loginAdmin'); // Asegúrate de que login.blade.php está en resources/views
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['usuario' => $request->username, 'password' => $request->password])) {
            // Redirigir al dashboard o página de bienvenida
            return redirect()->intended('/dashboard');
        }

        // Si falla la autenticación, regresar con un mensaje de error
        return back()->withErrors(['login_error' => 'Usuario o contraseña incorrectos']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/loginAdmin');
    }
}
