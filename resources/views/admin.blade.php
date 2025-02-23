<!DOCTYPE html>
<html>
<head>
    <title>Administrador</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
    <body>
        <h1>Panel de administración</h1>
        <div class="boton-container">
            <p><a href="{{ url('/crearCategoria') }}">Crear categoria</a><a href="{{ url('/crearProducto') }}">Crear producto</a></p>

            <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </body>
</html>
