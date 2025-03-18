<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
    <!-- Incluye jQuery si aún no lo has hecho -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <th>Acciones</th>
                    <th>Habilitar</th>
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
                        <td>
                            <button class="btn-editar" data-id="{{ $producto->id }}">Editar</button>
                        </td>
                        <td>
                            <!-- Checkbox para habilitar o deshabilitar el producto -->
                            <input type="checkbox" class="toggle-activado" data-id="{{ $producto->id }}" {{ $producto->activado ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p><a href="{{ url('/dashboard') }}">Volver</a></p>

    <!-- Modal de Edición (si ya tienes implementado ese modal) -->
    <!-- ... tu código para el modal ... -->

    <!-- Incluir el archivo JavaScript al final del body -->
    <script src="{{ asset('js/edicion.js') }}"></script>
    <script>
        // Código para manejar el cambio en el checkbox de activación
        $(document).on('change', '.toggle-activado', function(){
            var productoId = $(this).data('id');
            var activado = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: "{{ url('/productos/toggle-activado') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productoId,
                    activado: activado
                },
                success: function(response) {
                    alert(response.mensaje);
                },
                error: function() {
                    alert('Error al actualizar el estado del producto.');
                }
            });
        });
    </script>
</body>
</html>
