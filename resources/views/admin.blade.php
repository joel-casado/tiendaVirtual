<!DOCTYPE html>
<html>
<head>
    <title>Administrador</title>
</head>
    <body>
        <h1>Panel de administración</h1>
        <p><a href="{{ url('/crearCategoria') }}">Crear categoria</a></p>
        <p><a href="{{ url('/crearProducto') }}">Crear producto</a></p>
        <p><a href="{{ url('/logoutAdmin') }}">Cerrar sesión</a></p>
    </body>
</html>
