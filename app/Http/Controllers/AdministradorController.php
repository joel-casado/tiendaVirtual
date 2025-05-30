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
        return view('login'); // Asegúrate de que login.blade.php está en resources/views
    }

    // Procesar el login
    public function login(Request $request)
    {

        // Validar los datos del formulario
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        }

        // Si falla la autenticación, regresar con un mensaje de error
        return back()->withErrors(['login_error' => 'Usuario o contraseña incorrectos']);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect('/login'); // Redirige al login
    }

    public function dashboard()
    {
        return view('admin');
    }
    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password_nuevo' => 'required|min:8|confirmed',
        ]);

        $admin = Administrador::where('usuario', Auth::user()->usuario)->first(); // Obtener el administrador autenticado

        // Verificar si la contraseña actual es correcta
        if (!$admin || !Hash::check($request->password_actual, $admin->password)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual es incorrecta']);
        }

        // Actualizar la contraseña
        $admin->password = bcrypt($request->password_nuevo);
        $admin->save();

        return back()->with('success', 'Contraseña cambiada correctamente');
    }
    public function showChangePasswordForm()
    {
        return view('cambiarContraseña'); // Laravel buscará el archivo en resources/views/
    }


}
