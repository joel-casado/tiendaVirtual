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