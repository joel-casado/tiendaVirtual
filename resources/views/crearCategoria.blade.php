<!DOCTYPE html>
<html>
<head>
    <title>Categorias</title>
</head>
    <body>
        <h1>Crear categoria</h1>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ url('/crearCategoria') }}" method="POST">
            @csrf

            <input type="text" name="nombre_categoria">
            <button type="submit">Crear</button>
        </form>
        <form action="{{ url('/crearCategoria') }}" method="POST">
            @csrf
            <label></label>
            <input type="text" name="nombre_categoria">
            <button type="submit">Crear</button>
        </form>
        <form action="{{ url('/crearCategoria') }}" method="POST">
            <label></label>
            <input type="text" name="nombre_categoria" >
            <button type="submit">Crear</button>
        </form>
    </body>
</html>
