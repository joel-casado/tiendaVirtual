<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
        <form action="{{ url('/login') }}" method="post">
            @csrf
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Entrar">
            <p>
                <a href="{{ url('/views/cambiarContraseña') }}">¿Olvidaste tu contraseña?</a>
            </p>
        </form>
        <!-- Enlace para crear cuenta de comprador -->
        <p>
            <a href="{{ url('/registroComprador') }}">Crear cuenta de Comprador</a>
        </p>
    </div>
</body>
</html>
