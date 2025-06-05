<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-title">Bienvenido</div>
        @if ($errors->any())
            <div class="login-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="{{ url('/login') }}" method="post" class="login-form">
            @csrf
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" required autocomplete="username">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
            <input type="submit" value="Entrar">
        </form>
        <div class="login-links">
            <br>
            <a href="{{ url('/registroComprador') }}">Crear cuenta de Comprador</a>
        </div>
    </div>
</body>
</html>
