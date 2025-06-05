<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
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
        .admin-pedidos-container {
            background: color-mix(in srgb, var(--surface-color), transparent 85%);
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.12);
            padding: 40px 32px 32px 32px;
            max-width: 1100px;
            width: 100%;
            margin: 40px auto;
        }
        .admin-pedidos-title {
            color: var(--accent-color);
            font-family: var(--heading-font);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 28px;
            letter-spacing: 1px;
            text-align: center;
        }
        .pedidos-filtros {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
            justify-content: space-between;
        }
        .pedidos-filtros .estado-filtros {
            display: flex;
            gap: 10px;
        }
        .pedidos-filtros .estado-btn {
            background: none;
            color: var(--accent-color);
            border: 1.5px solid var(--accent-color);
            border-radius: 50px;
            padding: 6px 18px;
            font-family: var(--heading-font);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .pedidos-filtros .estado-btn.active,
        .pedidos-filtros .estado-btn:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
        }
        .pedidos-filtros .search-bar {
            flex: 1 1 220px;
            max-width: 320px;
        }
        .pedidos-filtros input[type="text"] {
            width: 100%;
            padding: 8px 14px;
            border-radius: 8px;
            border: 1.5px solid color-mix(in srgb, var(--accent-color), transparent 80%);
            background: color-mix(in srgb, var(--background-color), transparent 10%);
            color: var(--default-color);
            font-size: 1rem;
            font-family: var(--default-font);
        }
        .admin-pedidos-table-wrapper {
            overflow-x: auto;
        }
        .admin-pedidos-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: none;
            margin-bottom: 18px;
        }
        .admin-pedidos-table th, .admin-pedidos-table td {
            padding: 14px 10px;
            text-align: left;
            font-size: 1.01rem;
        }
        .admin-pedidos-table th {
            color: var(--accent-color);
            font-family: var(--heading-font);
            font-weight: 600;
            border-bottom: 2px solid var(--accent-color);
            background: none;
        }
        .admin-pedidos-table td {
            border-bottom: 1px solid color-mix(in srgb, var(--accent-color), transparent 80%);
        }
        .pedido-estado {
            font-size: 1rem;
            font-weight: 600;
            padding: 4px 16px;
            border-radius: 50px;
            background: color-mix(in srgb, var(--accent-color), transparent 85%);
            color: var(--accent-color);
            text-transform: capitalize;
            border: 1px solid var(--accent-color);
            display: inline-block;
        }
        .pedido-estado.enviada {
            background: #05965222;
            color: #059652;
            border-color: #059652;
        }
        .pedido-estado.pagado {
            background: #cda45e22;
            color: var(--accent-color);
            border-color: var(--accent-color);
        }
        .pedido-estado.pendiente {
            background: #df152922;
            color: #df1529;
            border-color: #df1529;
        }
        .admin-pedidos-table .btn-main {
            padding: 6px 18px;
            font-size: 0.98rem;
        }
        .admin-pedidos-table .btn-main.btn-outline {
            padding: 6px 18px;
        }
        .admin-pedidos-empty {
            text-align: center;
            padding: 40px 0;
            color: #888;
        }
        @media (max-width: 900px) {
            .admin-pedidos-container {
                padding: 18px 5px 18px 5px;
            }
            .admin-pedidos-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    let typingTimer;
    const $input = $('#buscar-pedidos');
    const $tbody = $('#pedidos-tbody');
    const $form = $('#filtrosForm');
    const $estadoHidden = $('#estado-hidden');

    // Estado filter button click
    $('.estado-btn').on('click', function() {
        $('.estado-btn').removeClass('active');
        $(this).addClass('active');
        $estadoHidden.val($(this).data('estado'));
        buscarPedidos();
    });

    // Live search
    $input.on('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(buscarPedidos, 300);
    });

    // Prevent form submit (we use AJAX)
    $form.on('submit', function(e) {
        e.preventDefault();
        buscarPedidos();
    });

    function buscarPedidos() {
        const estado = $estadoHidden.val();
        const buscar = $input.val();

        $.ajax({
            url: "{{ route('admin.pedidos') }}",
            type: 'GET',
            data: { estado, buscar, ajax: 1 },
            success: function(data) {
                $tbody.html(data);
            }
        });
    }
});
</script>

<body>
    <div class="admin-pedidos-container">
        <div class="admin-pedidos-title">Gestión de Pedidos</div>
        <form method="GET" class="pedidos-filtros" id="filtrosForm">
            <input type="hidden" name="estado" id="estado-hidden" value="{{ request('estado', '') }}">
            <div class="estado-filtros">
                <button type="button" data-estado="" class="estado-btn{{ request('estado') == '' ? ' active' : '' }}">Todos</button>
                <button type="button" data-estado="PENDIENTE" class="estado-btn{{ request('estado') == 'PENDIENTE' ? ' active' : '' }}">Pendiente</button>
                <button type="button" data-estado="PAGADO" class="estado-btn{{ request('estado') == 'PAGADO' ? ' active' : '' }}">Pagado</button>
                <button type="button" data-estado="ENVIADA" class="estado-btn{{ request('estado') == 'ENVIADA' ? ' active' : '' }}">Enviada</button>
            </div>
            <div class="search-bar">
                <input type="text" name="buscar" id="buscar-pedidos" placeholder="Buscar pedido, usuario, email..." value="{{ request('buscar') }}">
            </div>
        </form>
        <div class="admin-pedidos-table-wrapper">
            <table class="admin-pedidos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="pedidos-tbody">
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->comprador->nombre ?? '-' }}</td>
                            <td>{{ $pedido->comprador->email ?? '-' }}</td>
                            <td>{{ $pedido->fecha_compra }}</td>
                            <td>{{ number_format($pedido->precio_total, 2) }}€</td>
                            <td>
                                <span class="pedido-estado {{ strtolower($pedido->estado) }}">{{ ucfirst(strtolower($pedido->estado)) }}</span>
                            </td>
                            <td>
                                @if($pedido->estado === 'PAGADO')
                                    <form action="{{ route('admin.pedidos.enviar', $pedido->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-main btn-outline">Marcar como Enviada</button>
                                    </form>
                                @else
                                    <span style="color:#aaa;">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="admin-pedidos-empty">No se encontraron pedidos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="text-align:center; margin-top:18px;">
            <a href="{{ url('/dashboard') }}" class="btn-main btn-outline">← Volver</a>
        </div>
    </div>
</body>
</html>