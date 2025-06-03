<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Resumen de Pedido</h1>

    <p><strong>Cliente:</strong> {{ $comprador->nombre }}</p>
    <p><strong>Pedido #:</strong> {{ $compra->id }}</p>
    <p><strong>Fecha:</strong> {{ $compra->fecha_compra }}</p>
    <p><strong>Estado:</strong> {{ $compra->estado }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compra->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio_producto, 2) }}€</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precio_producto, 2) }}€</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: {{ number_format($compra->precio_total, 2) }}€</p>

</body>
</html>
