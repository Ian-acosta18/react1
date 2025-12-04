<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $primaryKey = 'id';
    
    // NOTA: En tu base de datos la columna se llama 'iamgen' (error de dedo), 
    // así que debemos respetarlo aquí.
    protected $fillable = ['categoria_id', 'nombre_servicio', 'precio', 'imagen'];
}