<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Ciudadano',
                'slug' => 'ciudadano',
                'description' => 'Usuario ciudadano que puede reportar incidencias'
            ],
            [
                'id' => 2,
                'name' => 'Funcionario',
                'slug' => 'funcionario',
                'description' => 'Funcionario municipal que gestiona incidencias'
            ],
            [
                'id' => 3,
                'name' => 'Administrador',
                'slug' => 'administrador',
                'description' => 'Administrador del sistema con permisos amplios'
            ],
            [
                'id' => 4,
                'name' => 'Alcalde',
                'slug' => 'alcalde',
                'description' => 'Máxima autoridad con acceso completo al sistema'
            ]
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['id' => $roleData['id']],
                $roleData
            );
        }
    }
}
