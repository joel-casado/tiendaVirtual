<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo_producto', 'nombre_producto', 'descripcion',
        'precio', 'id_categoria', 'stock', 'destacado'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_producto');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto');
    }
}
