<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Baches',
            'Alumbrado',
            'Limpieza',
            'Agua_Potable',
            'Alcantarillado',
            'Transporte_Publico',
            'Seguridad',
            'Ruido',
            'Parques_Jardines',
            'Semaforos',
            'Señalizacion',
            'Otros'
        ];

        $states = [
            'Pendiente',
            'En_Revision',
            'Derivada',
            'En_Proceso',
            'Solucionada',
            'Rechazada',
            'Cerrada'
        ];

        $descriptions = [
            'Baches' => 'Hay un bache muy grande en la calle que necesita reparación urgente.',
            'Alumbrado' => 'La lámpara del poste no funciona, la zona está muy oscura por las noches.',
            'Limpieza' => 'Acumulación de basura en la esquina que no ha sido recolectada.',
            'Agua_Potable' => 'Fuga de agua en la tubería principal que afecta el suministro.',
            'Alcantarillado' => 'Tapa de alcantarilla rota que representa peligro para peatones.',
            'Transporte_Publico' => 'El paradero de buses no tiene techo y está en mal estado.',
            'Seguridad' => 'Falta de iluminación en el parque genera inseguridad.',
            'Ruido' => 'Ruido excesivo de construcción fuera de horarios permitidos.',
            'Parques_Jardines' => 'Los juegos infantiles están rotos y son peligrosos.',
            'Semaforos' => 'El semáforo no funciona correctamente, causa problemas de tráfico.',
            'Señalizacion' => 'Falta señalización de stop en cruce peligroso.',
            'Otros' => 'Problema general que requiere atención de las autoridades.'
        ];

        $type = $this->faker->randomElement($types);
        
        return [
            'reference_user_id' => \App\Models\User::factory(),
            'type' => $type,
            'descripcion' => $descriptions[$type] ?? $this->faker->sentence(10),
            'state' => $this->faker->randomElement($states),
            'ubication' => $this->faker->streetAddress() . ', ' . $this->faker->city(),
        ];
    }
}
