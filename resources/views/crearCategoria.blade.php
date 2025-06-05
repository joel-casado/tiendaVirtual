
<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="form-crear-container">
        <div class="form-crear-title">Crear categoría</div>
        @if(session('success'))
            <p style="color: #8F1630;">{{ session('success') }}</p>
        @endif
        <form action="{{ url('/crearCategoria') }}" method="POST" class="form-crear-form">
            @csrf
            <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required>
            <button type="submit">Crear</button>
        </form>
        <a href="{{ url('/dashboard') }}">Volver</a>
    </div>
</body>
</html>
