<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Crear funcionarios adicionales para pruebas
        User::create([
            'name' => 'Ana García',
            'email' => 'ana.garcia@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Funcionario
        ]);

        User::create([
            'name' => 'Pedro Martínez',
            'email' => 'pedro.martinez@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Funcionario
        ]);

        User::create([
            'name' => 'Laura Rodríguez',
            'email' => 'laura.rodriguez@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Administrador
        ]);
    }
}
