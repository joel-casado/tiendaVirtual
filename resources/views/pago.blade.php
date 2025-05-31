<!DOCTYPE html>
<html>
<head>
    <title>Pagar pedido</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <h1>¡Gracias por tu pedido!</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p>Haz clic en el siguiente botón para completar tu pago:</p>

    <form method="POST" action="{{ route('pago.procesar') }}">
        @csrf
        <button type="submit" class="btn-book-a-table d-none d-xl-block">Pagar ahora</button>
    </form>

    <br>

    <a href="/" class="btn-book-a-table d-none d-xl-block">Volver al menú</a>

</body>
</html>
