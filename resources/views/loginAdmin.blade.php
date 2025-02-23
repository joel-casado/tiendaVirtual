<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
    <body>
        <!-- Mostrar errores de autenticación -->
        @if ($errors->any())
            <div style="color: red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="login-container">
            <form action="{{ url('/loginAdmin') }}"  method="post">
                @csrf
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="Entrar">
                <p>
                    <a href="{{ url('/views/cambiarContraseña') }}">¿Olvidaste tu contraseña?</a>
                </p>
            </form>
        </div>
    </body>
</html>
