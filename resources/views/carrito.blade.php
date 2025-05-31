<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <h1>Carrito de Compras</h1>

    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
        <a href="{{ url('/') }}" class="btn-book-a-table d-none d-xl-block">Volver al menú</a>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrito as $item)
                    @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>{{ number_format($item['precio'], 2) }}€</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>{{ number_format($subtotal, 2) }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: {{ number_format($total, 2) }}€</h3>

        <div style="margin-top: 20px;">
            <form action="{{ route('carrito.vaciar') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-book-a-table d-none d-xl-block">Vaciar carrito</button>
            </form>
            <form action="{{ route('carrito.confirmar') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-book-a-table d-none d-xl-block">Confirmar pedido</button>
            </form>



        </div>

        <p><a href="{{ url('/') }}">← Seguir comprando</a></p>
    @endif

</body>
</html>
