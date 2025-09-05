<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Usuarios que tienen este rol
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Constantes para los roles
     */
    const CIUDADANO = 1;
    const FUNCIONARIO = 2;
    const ADMINISTRADOR = 3;
    const ALCALDE = 4;
}
