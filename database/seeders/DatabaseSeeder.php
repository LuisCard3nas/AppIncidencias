<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // Luego crear usuarios de prueba
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 1, // Ciudadano por defecto
        ]);

        // Finalmente crear aplicaciones de prueba
        $this->call([
            ApplicationSeeder::class,
        ]);
    }
}
