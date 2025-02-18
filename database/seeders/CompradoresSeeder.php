<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrador;
use App\Models\Comprador;
use Illuminate\Support\Facades\Hash;

class compradoresSeeder extends Seeder
{
    public function run()
    {
        // Insertar un Administrador
        Administrador::create([
            'usuario' => 'admin',
            'password' => Hash::make('12345678'), // La contraseña será encriptada
        ]);

        // Insertar un Comprador
        Comprador::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('12345678'), // Contraseña encriptada
            'telefono' => '1234567890',
            'direccion' => 'Calle Falsa 123, Ciudad X'
        ]);
    }
}
