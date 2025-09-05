<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $citizens = User::where('role_id', 1)->get();
        $responsibles = User::whereIn('role_id', [2, 3])->get();
        
        $types = array_keys(Application::getTypes());
        $states = array_keys(Application::getStates());
        
        $locations = [
            'Av. Principal esquina con Calle 5',
            'Plaza Central del municipio',
            'Calle Los Robles, frente al parque',
            'Av. Libertador, sector comercial',
            'Barrio Las Flores, manzana 3',
            'Zona Industrial, entrada principal',
            'Calle Nueva, cerca del hospital',
            'Sector Centro, frente a la alcaldía',
            'Barrio San José, calle principal',
            'Av. Universidad, parada de autobús',
            'Mercado Municipal, entrada norte',
            'Parque Central, área de juegos',
            'Calle Comercio, frente al banco',
            'Barrio El Progreso, esquina principal',
            'Zona Residencial Los Pinos'
        ];
        
        $descriptions = [
            'Se observa un bache de gran tamaño que representa un peligro para los vehículos y peatones.',
            'Las luminarias del sector han estado sin funcionar por más de una semana.',
            'Acumulación de basura en la vía pública que no ha sido recolectada.',
            'Falta de suministro de agua potable en el sector desde hace varios días.',
            'Problemas con el sistema de alcantarillado, se observan malos olores.',
            'Falta de transporte público en esta ruta durante las horas pico.',
            'Situaciones de inseguridad reportadas por los vecinos del sector.',
            'Ruidos excesivos durante horas de descanso que afectan a la comunidad.',
            'Los espacios verdes necesitan mantenimiento y cuidado urgente.',
            'El semáforo del cruce no está funcionando correctamente.',
            'Falta de señalización vial en esta zona de alta circulación.',
            'Solicitud de mejoras en la infraestructura del sector.',
            'Problema con el drenaje de aguas de lluvia en la zona.',
            'Necesidad de mejoras en el alumbrado público nocturno.',
            'Reporte de daños en la superficie de la vía pública.'
        ];

        // Crear 25 aplicaciones de prueba
        for ($i = 0; $i < 25; $i++) {
            $application = Application::create([
                'reference_user_id' => $citizens->random()->id,
                'type' => $types[array_rand($types)],
                'descripcion' => $descriptions[array_rand($descriptions)],
                'state' => $states[array_rand($states)],
                'ubication' => $locations[array_rand($locations)],
                'responsible_user_id' => rand(0, 1) ? $responsibles->random()->id : null,
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 15)),
            ]);
        }
    }
}
