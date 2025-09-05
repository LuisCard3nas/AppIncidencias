<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reference_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('responsible_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type', [
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
            ]);
            $table->text('descripcion');
            $table->enum('state', [
                'Pendiente',
                'En_Revision',
                'Derivada',
                'En_Proceso',
                'Solucionada',
                'Rechazada',
                'Cerrada'
            ])->default('Pendiente');
            $table->string('ubication');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
