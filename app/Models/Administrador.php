<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Authenticatable

{
    use HasFactory;

    protected $table = 'administradores';

    public function administradores()
    {
        return $this->hasMany(Administrador::class, 'id_administrador');
    }
    use Notifiable;
    protected $primaryKey = 'id'; // Clave primaria
    public $timestamps = true; // Cambiar a false si no usas created_at y updated_at

    protected $fillable = ['usuario', 'password']; // Campos permitidos

    protected $hidden = ['password']; // Oculta la contraseña en las respuestas JSON
}
