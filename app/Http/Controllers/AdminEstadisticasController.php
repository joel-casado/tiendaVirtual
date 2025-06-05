<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEstadisticasController extends Controller
{
    public function index()
    {
        // Ventas por mes (últimos 6 meses)
        $ventas = DB::table('compras')
            ->selectRaw("DATE_FORMAT(fecha_compra, '%Y-%m') as mes, SUM(precio_total) as total")
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->limit(6)
            ->get()->reverse();

        $ventasMesLabels = $ventas->pluck('mes');
        $ventasMesData = $ventas->pluck('total');

        // Productos más vendidos (top 5)
        $productos = DB::table('detalle_compras')
            ->join('productos', 'detalle_compras.id_producto', '=', 'productos.id')
            ->select('productos.nombre_producto', DB::raw('SUM(detalle_compras.cantidad) as total_vendidos'))
            ->groupBy('productos.nombre_producto')
            ->orderByDesc('total_vendidos')
            ->limit(5)
            ->get();

        $productosVendidosLabels = $productos->pluck('nombre_producto');
        $productosVendidosData = $productos->pluck('total_vendidos');

        return view('estadisticas', compact(
            'ventasMesLabels', 'ventasMesData',
            'productosVendidosLabels', 'productosVendidosData'
        ));
    }
}