<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con el rol del usuario
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación con las aplicaciones del usuario
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'reference_user_id');
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    public function hasRole(string $role): bool
    {
        return $this->role && $this->role->slug === $role;
    }

    /**
     * Verificar si es ciudadano
     */
    public function isCiudadano(): bool
    {
        return $this->role_id === Role::CIUDADANO;
    }

    /**
     * Verificar si es funcionario
     */
    public function isFuncionario(): bool
    {
        return $this->role_id === Role::FUNCIONARIO;
    }

    /**
     * Verificar si es administrador
     */
    public function isAdministrador(): bool
    {
        return $this->role_id === Role::ADMINISTRADOR;
    }

    /**
     * Verificar si es alcalde
     */
    public function isAlcalde(): bool
    {
        return $this->role_id === Role::ALCALDE;
    }
}
