<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero crear los roles
        $this->call([
            RoleSeeder::class,
        ]);

        // Crear usuarios de prueba específicos para el README
        
        // Alcalde
        User::create([
            'name' => 'Alcalde Municipal',
            'email' => 'alcalde@test.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // Alcalde
        ]);

        // Administrador
        User::create([
            'name' => 'Administrador Sistema',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Administrador
        ]);

        // Funcionario
        User::create([
            'name' => 'Funcionario Municipal',
            'email' => 'funcionario@test.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Funcionario
        ]);

        // Ciudadano
        User::create([
            'name' => 'Ciudadano Test',
            'email' => 'ciudadano@test.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Ciudadano
        ]);

        // Crear algunos usuarios adicionales para pruebas
        User::factory(5)->create([
            'role_id' => 1, // Ciudadanos adicionales
        ]);

        // Finalmente crear aplicaciones de prueba y usuarios adicionales
        $this->call([
            FuncionarioSeeder::class,
            ApplicationSeeder::class,
            TestApplicationsSeeder::class,
        ]);
    }
}
