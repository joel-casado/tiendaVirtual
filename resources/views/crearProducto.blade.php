<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="form-crear-container">
        <div class="form-crear-title">Crear producto</div>
        @if(session('success'))
            <p style="color: #8F1630;">{{ session('success') }}</p>
        @endif
        <form action="{{ url('/crearProducto') }}" method="POST" enctype="multipart/form-data" class="form-crear-form">
            @csrf
            <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
            <input type="text" name="descripcion" placeholder="Descripción del producto" required>
            <input type="number" name="precio" placeholder="Precio del producto" step="0.01" required>
            <input type="number" name="stock" placeholder="Stock" required>
            <select name="destacado" required>
                <option value="">Selecciona si es destacado</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
            <select name="id_categoria" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
            <input type="file" name="imagen" id="imagen" accept="image/*">
            <button type="submit">Crear</button>
        </form>
        <a href="{{ url('/dashboard') }}">Volver</a>
    </div>
</body>
</html>
