<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    
    // Campos que permitimos asignar masivamente
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen', 'stock', 'activo'];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
        'stock'  => 'integer',
    ];
}