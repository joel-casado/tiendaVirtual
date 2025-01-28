<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

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
