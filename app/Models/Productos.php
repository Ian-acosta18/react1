<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    // Por defecto Laravel buscará la tabla 'productos'.
    // Si tu tabla tiene otro nombre (ej. 'inventory'), descomenta la siguiente línea:
    // protected $table = 'inventario';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen', // Para guardar la ruta o nombre del archivo (ej: 'shampoo.jpg')
        'stock',
        'activo', // Para ocultar el producto sin borrarlo de la BD
    ];

    /**
     * Los atributos que se deben convertir a tipos nativos.
     * Esto asegura que 'precio' sea un decimal y 'activo' un booleano (true/false).
     */
    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
        'stock'  => 'integer',
    ];
}