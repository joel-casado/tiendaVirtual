<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="pedidos-page" style="background: var(--background-color); color: var(--default-color); font-family: var(--default-font);">
    <div class="container pedidos-container">
        <h1 class="pedidos-title">Historial de pedidos de {{ $comprador->nombre }}</h1>

        @forelse($compras as $compra)
            <div class="pedido-card">
                <div class="pedido-header">
                    <h3>Pedido #{{ $compra->id }}</h3>
                    <span class="pedido-estado {{ strtolower($compra->estado) }}">{{ $compra->estado }}</span>
                </div>
                <div class="pedido-info">
                    <span><strong>Fecha:</strong> {{ $compra->fecha_compra }}</span>
                    <span><strong>Total:</strong> {{ number_format($compra->precio_total, 2) }}€</span>
                </div>
                <div class="pedido-productos">
                    <h4>Productos:</h4>
                    <ul>
                        @foreach($compra->detalles as $detalle)
                            <li>
                                <span class="producto-nombre">{{ $detalle->producto->nombre_producto }}</span>
                                <span class="producto-cantidad">{{ $detalle->cantidad }} × {{ number_format($detalle->precio_producto, 2) }}€</span>
                                <span class="producto-total">= <strong>{{ number_format($detalle->cantidad * $detalle->precio_producto, 2) }}€</strong></span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="pedido-actions">
                    <a href="{{ route('pedido.pdf', $compra->id) }}" class="btn-main btn-outline">
                        Descargar PDF
                    </a>
                </div>
            </div>
        @empty
            <div class="pedidos-empty">
                <p>No has realizado ningún pedido aún.</p>
                <a href="/" class="btn-main">Volver al menú</a>
            </div>
        @endforelse

        @if(count($compras))
            <div class="pedidos-back">
                <a href="/" class="btn-main btn-outline">Volver al menú</a>
            </div>
        @endif
    </div>
</body>
</html>
