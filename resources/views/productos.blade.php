<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="productos-container">
        <div class="productos-title">Listado de Productos en Stock</div>

        @if(session('success'))
            <p style="color: #8F1630;">{{ session('success') }}</p>
        @endif

        <div class="productos-table-wrapper">
            <table class="productos-table">
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
                <tbody id="productos-tbody">
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
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre_producto }}" style="max-width: 80px; border-radius: 8px;">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>
                                <button class="btn-editar" data-id="{{ $producto->id }}">Editar</button>
                            </td>
                            <td>
                                <input type="checkbox" class="toggle-activado" data-id="{{ $producto->id }}" {{ $producto->activado ? 'checked' : '' }}>
                                <span class="estado-label" style="color:{{ $producto->activado ? '#059652' : '#df1529' }}">{{ $producto->activado ? 'Habilitado' : 'Deshabilitado' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="modal-editar" style="display: none;">
            <form id="form-editar" action="{{ url('/productos/editar') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="producto-id">
                <label for="producto-precio">Precio:</label>
                <input type="number" step="0.01" name="precio" id="producto-precio" required>
                <label for="producto-stock">Stock:</label>
                <input type="number" name="stock" id="producto-stock" required>
                <select name="destacado" id="producto-destacado" required>
                    <option value="">Selecciona si es destacado</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
                <button type="submit" class="btn-editar">Guardar cambios</button>
                <button type="button" id="cerrar-modal">Cerrar</button>
            </form>
        </div>

        <p style="margin-top:24px;"><a href="{{ url('/dashboard') }}" class="btn-editar" style="background:none;color:var(--accent-color);border:1.5px solid var(--accent-color);">Volver</a></p>
    </div>

    <script src="{{ asset('js/edicion.js') }}"></script>
    <script>
        // Toggle habilitar/deshabilitar con color y AJAX
        $(document).on('change', '.toggle-activado', function(){
            var $checkbox = $(this);
            var productoId = $checkbox.data('id');
            var activado = $checkbox.is(':checked') ? 1 : 0;
            var $label = $checkbox.next('.estado-label');
            $.ajax({
                url: "{{ url('/productos/toggle-activado') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productoId,
                    activado: activado
                },
                success: function(response) {
                    if(activado) {
                        $checkbox.css('background', '#059652');
                        $label.text('Habilitado').css('color', '#059652');
                    } else {
                        $checkbox.css('background', '#df1529');
                        $label.text('Deshabilitado').css('color', '#df1529');
                    }
                },
                error: function() {
                    alert('Error al actualizar el estado del producto.');
                    $checkbox.prop('checked', !activado);
                }
            });
        });
    </script>
</body>
</html>
