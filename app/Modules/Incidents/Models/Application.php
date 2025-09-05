<?php

namespace App\Modules\Incidents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_user_id',
        'type',
        'descripcion',
        'state',
        'ubication',
        'responsible_user_id'
    ];

    // Constantes para los tipos de aplicaciones
    const TYPE_BACHES = 'Baches';
    const TYPE_ALUMBRADO = 'Alumbrado';
    const TYPE_LIMPIEZA = 'Limpieza';
    const TYPE_AGUA_POTABLE = 'Agua_Potable';
    const TYPE_ALCANTARILLADO = 'Alcantarillado';
    const TYPE_TRANSPORTE_PUBLICO = 'Transporte_Publico';
    const TYPE_SEGURIDAD = 'Seguridad';
    const TYPE_RUIDO = 'Ruido';
    const TYPE_PARQUES_JARDINES = 'Parques_Jardines';
    const TYPE_SEMAFOROS = 'Semaforos';
    const TYPE_SEÑALIZACION = 'Señalizacion';
    const TYPE_OTROS = 'Otros';

    // Constantes para los estados
    const STATE_PENDIENTE = 'Pendiente';
    const STATE_EN_REVISION = 'En_Revision';
    const STATE_DERIVADA = 'Derivada';
    const STATE_EN_PROCESO = 'En_Proceso';
    const STATE_SOLUCIONADA = 'Solucionada';
    const STATE_RECHAZADA = 'Rechazada';
    const STATE_CERRADA = 'Cerrada';

    // Relación con el usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reference_user_id');
    }

    // Relación con el usuario responsable
    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    // Métodos helper para obtener arrays de opciones
    public static function getTypes(): array
    {
        return [
            self::TYPE_BACHES => 'Baches',
            self::TYPE_ALUMBRADO => 'Alumbrado Público',
            self::TYPE_LIMPIEZA => 'Limpieza',
            self::TYPE_AGUA_POTABLE => 'Agua Potable',
            self::TYPE_ALCANTARILLADO => 'Alcantarillado',
            self::TYPE_TRANSPORTE_PUBLICO => 'Transporte Público',
            self::TYPE_SEGURIDAD => 'Seguridad',
            self::TYPE_RUIDO => 'Ruido',
            self::TYPE_PARQUES_JARDINES => 'Parques y Jardines',
            self::TYPE_SEMAFOROS => 'Semáforos',
            self::TYPE_SEÑALIZACION => 'Señalización',
            self::TYPE_OTROS => 'Otros'
        ];
    }

    public static function getStates(): array
    {
        return [
            self::STATE_PENDIENTE => 'Pendiente',
            self::STATE_EN_REVISION => 'En Revisión',
            self::STATE_DERIVADA => 'Derivada',
            self::STATE_EN_PROCESO => 'En Proceso',
            self::STATE_SOLUCIONADA => 'Solucionada',
            self::STATE_RECHAZADA => 'Rechazada',
            self::STATE_CERRADA => 'Cerrada'
        ];
    }

    // Métodos helper para verificar estado
    public function isPendiente(): bool
    {
        return $this->state === self::STATE_PENDIENTE;
    }

    public function isEnRevision(): bool
    {
        return $this->state === self::STATE_EN_REVISION;
    }

    public function isDerivada(): bool
    {
        return $this->state === self::STATE_DERIVADA;
    }

    public function isEnProceso(): bool
    {
        return $this->state === self::STATE_EN_PROCESO;
    }

    public function isSolucionada(): bool
    {
        return $this->state === self::STATE_SOLUCIONADA;
    }

    public function isRechazada(): bool
    {
        return $this->state === self::STATE_RECHAZADA;
    }

    public function isCerrada(): bool
    {
        return $this->state === self::STATE_CERRADA;
    }

    // Scope para filtrar por estado
    public function scopeByState($query, $state)
    {
        return $query->where('state', $state);
    }

    // Scope para filtrar por tipo
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope para filtrar por usuario
    public function scopeByUser($query, $userId)
    {
        return $query->where('reference_user_id', $userId);
    }
}
