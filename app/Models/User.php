<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'rol',          // admin, supervisor, user
        'password',
        'is_active',    // Nuevo campo
        'last_login_at',// Nuevo campo
        'last_login_ip' // Nuevo campo
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean', // Importante para verificar bloqueos
            'last_login_at' => 'datetime',
        ];
    }
    
    // Helper para saber si es admin
    public function isAdmin() {
        return $this->rol === 'admin';
    }

    // Helper para saber si es supervisor
    public function isSupervisor() {
        return $this->rol === 'supervisor';
    }
}