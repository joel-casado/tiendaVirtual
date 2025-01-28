<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    use HasFactory;

    protected $table = 'compradores';

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_comprador');
    }
}
