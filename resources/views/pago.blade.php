<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar pedido</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="pago-page" style="background: var(--background-color); color: var(--default-color); font-family: var(--default-font);">
    <div class="container pago-container">
        <h1 class="pago-title">¡Gracias por tu pedido!</h1>

        @if(session('success'))
            <div class="pago-success-msg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="pago-error-msg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <p class="pago-info">Haz clic en el siguiente botón para completar tu pago:</p>

        <form method="POST" action="{{ route('pago.procesar') }}" class="pago-form">
            @csrf
            <button type="submit" class="btn-main">Pagar ahora</button>
        </form>

        <div class="pago-back">
            <a href="/" class="btn-main btn-outline">Volver al menú</a>
        </div>
    </div>
</body>
</html>
