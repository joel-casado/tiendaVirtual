<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
    <body>
        <h1>Crear Productos</h1>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ url('/crearProducto') }}" method="POST">
            @csrf

            <input type="text" name="nombre_producto">
            <button type="submit">Crear</button>
        </form>
        <form action="{{ url('/crearProducto') }}" method="POST">
            @csrf
            <label></label>
            <input type="text" name="nombre_producto">
            <button type="submit">Crear</button>
        </form>
        <form action="{{ url('/crearProducto') }}" method="POST">
            <label></label>
            <input type="text" name="nombreProducto" >
            <button type="submit">Crear</button>
        </form>
    </body>
</html>
