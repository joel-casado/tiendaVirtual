<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        <form action="{{ url('/loginAdmin') }}"  method="post">
            @csrf
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Entrar">
        </form>
    </body>
</html>
