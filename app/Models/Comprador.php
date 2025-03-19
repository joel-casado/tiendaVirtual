<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Si quieres que se autentiquen
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comprador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'compradores';

    protected $fillable = [
        'email', 'password', 'telefono', 'nombre', 'apellidos', 'direccion'
    ];

    protected $hidden = [
        'password',
    ];
}
