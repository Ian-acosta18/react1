<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre_servicio',
        'categoria_id',
        'precio',
        'imagen',
        'activo' // <--- NUEVO CAMPO
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Scope para filtrar solo los activos (útil para la página pública)
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}