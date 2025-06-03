<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Comprador</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('/registroComprador') }}" method="POST" autocomplete="off">
        <h1>Crear cuenta de Comprador</h1>
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>

        <label for="direccion">Dirección:</label>
        <textarea name="direccion" id="direccion" required></textarea>

        <div class="form-actions">
            <button type="submit">Crear Cuenta</button>
            <a href="{{ url('/') }}">Volver</a>
        </div>
    </form>
</body>
</html>
