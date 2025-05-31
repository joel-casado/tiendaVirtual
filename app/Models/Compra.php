<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    public function comprador()
    {
        return $this->belongsTo(Comprador::class, 'id_comprador');
    }

    public function detalles()
    {
        return $this->hasMany(\App\Models\DetalleCompra::class, 'id_compra');
    }

    protected $fillable = [
        'id_comprador',
        'precio_total',
        'estado',
        'fecha_compra',
        'fecha_envio'
    ];


}

