<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="/css/productos.css">
</head>
<body>
    <h1>Listado de Productos en Stock</h1>

    @if(session('success'))
        <p style="color: #8F1630;">{{ session('success') }}</p>
    @endif

    @if($productos->isEmpty())
        <p>No hay productos en stock.</p>
    @else
        <table border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Destacado</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->codigo_producto }}</td>
                        <td>{{ $producto->nombre_producto }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->categoria ? $producto->categoria->nombre_categoria : 'Sin categoría' }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->destacado ? 'Sí' : 'No' }}</td>
                        <td>
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre_producto }}" style="max-width: 100px;">
                            @else
                                Sin imagen
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p><a href="{{ url('/dashboard') }}">Volver</a></p>
</body>
</html>
