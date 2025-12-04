<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $table = 'citas'; // Vincula con tu tabla SQL 'citas'
    
    protected $fillable = [
        'nombre',
        'apaterno',
        'amaterno',
        'correo', 
        'telefono', 
        'fechadeseada', // Nombre corregido
        'horadeseada',
        'mensajeadd',   // Nombre corregido (antes tenías 'mensaje')
        'servicios',
    ];

    protected $casts = [
        'servicios' => 'array', 
    ];
}