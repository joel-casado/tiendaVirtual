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
        <form action="{{ url('/crearProducto') }}" method="POST">
            @csrf
            <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
            <input type="text" name="descripcion" placeholder="Descripcion del producto" required>
            <input type="number" name="precio" placeholder="Precio del producto" step="0.01" required>
            <input type="number" name="stock" placeholder="Stock" required>
            <input type="text" name="deastacado" placeholder="destacado" required>
            <select name="id_categoria" required>
                <option value="">Selecciona una categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
            <button type="submit">Crear</button>
        </form>
    </div>
</body>
</html>
