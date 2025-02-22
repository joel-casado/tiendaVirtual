<?php

use Illuminate\Database\Seeder;
use App\Models\Administrador;
use App\Models\Comprador;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insertar un Administrador
        Administrador::create([
            'usuario' => 'admin',
            'password' => 'admin', // La contraseña será encriptada
        ]);

        // Insertar un Comprador
        Comprador::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'email' => 'juan@example.com',
            'password' => Hash::make('1234'), // Contraseña encriptada
            'telefono' => '1234567890',
            'direccion' => 'Calle Falsa 123, Ciudad X'
        ]);
    }
}
