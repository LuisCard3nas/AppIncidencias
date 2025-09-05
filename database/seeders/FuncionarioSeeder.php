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
        // Crear funcionarios
        User::create([
            'name' => 'Juan Funcionario',
            'email' => 'funcionario@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Funcionario
        ]);

        User::create([
            'name' => 'María Responsable',
            'email' => 'maria.responsable@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Funcionario
        ]);

        // Crear un administrador adicional
        User::create([
            'name' => 'Carlos Admin',
            'email' => 'admin2@municipalidad.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Administrador
        ]);
    }
}
