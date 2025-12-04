<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 1. Vinculamos a la tabla 'usuarios'
    protected $table = 'usuarios';

    // 2. Definimos tu llave primaria (si es id_usuario)
    protected $primaryKey = 'id_usuario';

    // 3. Indicamos qué campos se pueden llenar
    protected $fillable = [
        'nombre',   // En lugar de 'name'
        'correo',   // En lugar de 'email'
        'password', // La contraseña debe llamarse password o clave
        'activo',   // Para saber si el usuario está activo
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}