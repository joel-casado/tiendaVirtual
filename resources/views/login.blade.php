<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const usuario = document.getElementById('usuario');
    const password = document.getElementById('password');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/;

    if (!emailRegex.test(usuario.value)) {
        alert('Introduce un correo electrónico válido.');
        usuario.focus();
        e.preventDefault();
        return false;
    }
    if (!passwordRegex.test(password.value)) {
        alert('La contraseña debe tener al menos 6 caracteres, incluyendo letras y números.');
        password.focus();
        e.preventDefault();
        return false;
    }
});
</script>
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
        <form action="{{ url('/login') }}" method="post" class="login-form" id="loginForm">
            @csrf
            <label for="usuario">Correo electrónico</label>
            <input type="text" name="usuario" id="usuario" required autocomplete="username"
                pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
                title="Introduce un correo electrónico válido.">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="current-password"
                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$"
                title="La contraseña debe tener al menos 6 caracteres, incluyendo letras y números.">
            <input type="submit" value="Entrar">
        </form>
        <div class="login-links">
            <br>
            <a href="{{ url('/registroComprador') }}">Crear cuenta de Comprador</a>
        </div>
    </div>
</body>
</html>
