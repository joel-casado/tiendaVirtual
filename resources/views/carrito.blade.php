<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="carrito-page" style="background: var(--background-color); color: var(--default-color); font-family: var(--default-font);">
    <div class="container carrito-container">
        <h1 class="carrito-title">Tu Carrito</h1>

        @if(empty($carrito))
            <div class="carrito-empty">
                <p>Tu carrito está vacío.</p>
                <a href="{{ url('/') }}" class="btn-main">Volver al menú</a>
            </div>
        @else
            <div class="carrito-table-wrapper">
                <table class="carrito-table">
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
                        @foreach($carrito as $productoId => $item)
                            @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>{{ number_format($item['precio'], 2) }}€</td>
                                <td>
                                    <form action="{{ route('carrito.actualizar') }}" method="POST" class="carrito-cantidad-form" style="display:inline-flex;align-items:center;gap:4px;">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $productoId }}">
                                        <button type="submit" name="accion" value="restar" class="btn-cantidad" @if($item['cantidad'] <= 1) disabled @endif>-</button>
                                        <span class="cantidad-num">{{ $item['cantidad'] }}</span>
                                        <button type="submit" name="accion" value="sumar" class="btn-cantidad">+</button>
                                    </form>
                                </td>
                                <td>{{ number_format($subtotal, 2) }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="carrito-total">
                <span>Total:</span>
                <span class="carrito-total-amount">{{ number_format($total, 2) }}€</span>
            </div>

            <div class="carrito-actions">
                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-main btn-outline">Vaciar carrito</button>
                </form>
                <form action="{{ route('carrito.confirmar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-main">Confirmar pedido</button>
                </form>
            </div>
            @if(!session('comprador'))
                <p class="carrito-login-msg">
                    Para pagar necesitarás iniciar sesión o registrarte.
                </p>
            @endif

            <div class="carrito-back">
                <a href="{{ url('/') }}">← Seguir comprando</a>
            </div>
        @endif
    </div>
</body>
</html>
