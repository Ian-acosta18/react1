<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalaciones extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos
     */
    protected $table = 'instalaciones';

    /**
     * Los atributos que se pueden asignar masivamente
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'orden',
        'activo'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos
     */
    protected $casts = [
        'activo' => 'boolean',
        'orden' => 'integer',
    ];

    /**
     * Scope para obtener solo las instalaciones activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope para ordenar por el campo 'orden'
     */
    public function scopeOrdenadas($query)
    {
        return $query->orderBy('orden', 'asc');
    }
}