<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Comprador;

class AdminPedidosController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Compra::with('comprador');
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('id', 'like', "%$buscar%")
                ->orWhereHas('comprador', function($q2) use ($buscar) {
                    $q2->where('nombre', 'like', "%$buscar%")
                        ->orWhere('email', 'like', "%$buscar%");
                });
            });
        }
        $pedidos = $query->orderByDesc('fecha_compra')->get();

        if ($request->ajax()) {
            return view('partials.pedidos_tbody', compact('pedidos'))->render();
        }

        return view('admin_pedidos', compact('pedidos'));
    }

    public function marcarEnviada($id)
    {
        $pedido = Compra::findOrFail($id);
        if ($pedido->estado === 'PAGADO') {
            $pedido->estado = 'ENVIADA';
            $pedido->fecha_envio = now();
            $pedido->save();
        }
        return redirect()->back()->with('success', 'Pedido marcado como enviado.');
    }
}