<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de administración</title>
    <link rel="stylesheet" href="/css/main.css">
    <style>
        body {
            min-height: 100vh;
            background: var(--background-color);
            color: var(--default-color);
            font-family: var(--default-font);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .admin-container {
            background: color-mix(in srgb, var(--surface-color), transparent 85%);
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.12);
            padding: 40px 32px 32px 32px;
            max-width: 480px;
            width: 100%;
            margin: 40px auto;
            text-align: center;
        }
        .admin-title {
            color: var(--accent-color);
            font-family: var(--heading-font);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }
        .admin-btns {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 32px;
        }
        .admin-btn {
            background: var(--accent-color);
            color: var(--contrast-color);
            border: none;
            border-radius: 50px;
            padding: 14px 0;
            font-family: var(--heading-font);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            box-shadow: 0 2px 8px rgba(205,164,94,0.08);
            width: 100%;
            display: block;
            text-decoration: none;
        }
        .admin-btn:hover, .admin-btn:focus {
            background: #fff;
            color: var(--accent-color);
            border: 1.5px solid var(--accent-color);
        }
        .admin-logout-form {
            margin-top: 18px;
        }
        .admin-logout-btn {
            background: none;
            color: var(--accent-color);
            border: 1.5px solid var(--accent-color);
            border-radius: 50px;
            padding: 10px 0;
            font-family: var(--heading-font);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s, color 0.2s;
        }
        .admin-logout-btn:hover, .admin-logout-btn:focus {
            background: var(--accent-color);
            color: var(--contrast-color);
        }
        @media (max-width: 600px) {
            .admin-container {
                padding: 18px 5px 18px 5px;
            }
            .admin-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-title">Panel de administración</div>
        <div class="admin-btns">
            <a href="{{ url('/crearCategoria') }}" class="admin-btn">Crear categoría</a>
            <a href="{{ url('/crearProducto') }}" class="admin-btn">Crear producto</a>
            <a href="{{ url('/productos') }}" class="admin-btn">Ver productos existentes</a>
            <a href="{{ url('/estadisticas') }}" class="admin-btn">Ver estadísticas</a>
            <a href="{{ url('/admin/pedidos') }}" class="admin-btn">Ver todos los pedidos</a>
        </div>
        <form action="{{ url('/logout') }}" method="POST" class="admin-logout-form">
            @csrf
            <button type="submit" class="admin-logout-btn">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
