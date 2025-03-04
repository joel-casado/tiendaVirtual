<!DOCTYPE html>
<html>
<head>
    <title>Categorias</title>
    <link rel="stylesheet" href="/css/crearCategoria.css">
</head>
    <body>
        <h1>Crear categoria</h1>
        @if(session('success'))
            <p style="color: #8F1630;">{{ session('success') }}</p>
        @endif
        <div class="categoria-container">
            <form action="{{ url('/crearCategoria') }}" method="POST">
                @csrf
                <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required>
                <button type="submit">Crear</button>
            </form>
            <p><a href="{{ url('/dashboard') }}">Volver</a></p>
        </div>

    </body>
</html>
