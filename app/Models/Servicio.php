<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $primaryKey = 'id';

    protected $fillable = ['categoria_id', 'nombre_servicio', 'precio'];

    // Relación Inversa: Un servicio pertenece a una categoría
    public function categoria()
    {
        // CORRECCIÓN CLAVE: Usamos 'categoria_id' que es lo que está en la BD
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id'); 
    }
}