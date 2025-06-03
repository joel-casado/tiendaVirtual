<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <h1>Historial de pedidos de {{ $comprador->nombre }}</h1>

    @forelse($compras as $compra)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            <h3>Pedido #{{ $compra->id }}</h3>
            <p><strong>Fecha:</strong> {{ $compra->fecha_compra }}</p>
            <p><strong>Estado:</strong> {{ $compra->estado }}</p>
            <p><strong>Total:</strong> {{ number_format($compra->precio_total, 2) }}€</p>

            <h4>Productos:</h4>
            <ul>
                @foreach($compra->detalles as $detalle)
                    <li>
                        {{ $detalle->producto->nombre_producto }} —
                        {{ $detalle->cantidad }} × {{ number_format($detalle->precio_producto, 2) }}€ =
                        <strong>{{ number_format($detalle->cantidad * $detalle->precio_producto, 2) }}€</strong>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('pedido.pdf', $compra->id) }}" class="btn-book-a-table d-none d-xl-block" style="margin-top: 10px;">
            Descargar PDF
        </a>

    @empty
        <p>No has realizado ningún pedido aún.</p>
    @endforelse

    <a href="/" class="btn-book-a-table d-none d-xl-block">Volver al menú</a>

</body>
</html>
