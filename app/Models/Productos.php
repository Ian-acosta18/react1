<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'activo' // <--- NUEVO CAMPO
    ];

    // Scope para filtrar solo los activos (útil para la vista pública)
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}