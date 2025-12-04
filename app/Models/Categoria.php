<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre_categoria'];

   public function servicios()
    {
        // Una categoría TIENE MUCHOS servicios
        // Relación: 'categoria_id' es la llave foránea en la tabla 'servicios'
        return $this->hasMany(Servicio::class, 'categoria_id', 'id');
    }
}