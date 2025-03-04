<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <link rel="stylesheet" href="/css/crearProductos.css">
</head>
<body>
    <h1>Crear producto</h1>
    @if(session('success'))
        <p style="color: #8F1630;">{{ session('success') }}</p>
    @endif
    <div class="producto-container">
        <form action="{{ url('/crearProducto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
            <input type="text" name="descripcion" placeholder="Descripción del producto" required>
            <input type="number" name="precio" placeholder="Precio del producto" step="0.01" required>
            <input type="number" name="stock" placeholder="Stock" required>

            <!-- Desplegable para "destacado" -->
            <select name="destacado" required>
                <option value="">Selecciona si es destacado</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>

            <select name="id_categoria" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
             <!-- Campo para cargar la foto del producto -->
            <input type="file" name="imagen" id="imagen" accept="image/*">
            <button type="submit">Crear</button>
        </form>
        <p><a href="{{ url('/dashboard') }}">Volver</a></p>
    </div>

</body>
</html>
