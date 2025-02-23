<link rel="stylesheet" href="/css/login.css">
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ url('/views/cambiarContraseña') }}" method="POST">
    @csrf
    <label>Contraseña actual:</label>
    <input type="password" name="password_actual" required>

    <label>Nueva contraseña:</label>
    <input type="password" name="password_nuevo" required>

    <label>Confirmar nueva contraseña:</label>
    <input type="password" name="password_nuevo_confirmation" required>

    <button type="submit">Cambiar contraseña</button>
</form>
