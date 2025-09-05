<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios existentes con rol de ciudadano
        $ciudadanos = \App\Models\User::where('role_id', 1)->get();
        
        if ($ciudadanos->count() > 0) {
            // Crear aplicaciones para ciudadanos existentes
            foreach ($ciudadanos as $ciudadano) {
                \App\Models\Application::factory(rand(2, 5))->create([
                    'reference_user_id' => $ciudadano->id
                ]);
            }
        } else {
            // Si no hay ciudadanos, crear algunas aplicaciones con usuarios nuevos
            \App\Models\Application::factory(15)->create();
        }
    }
}
