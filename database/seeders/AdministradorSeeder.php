<?php

namespace database\Seeders;
use App\Models\Administrador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{

    public function run()
    {
        Administrador::create([
            'usuario' => 'admin',
            'password' => Hash::make('admin'), // La contraseña será encriptada
        ]);
    }
}
