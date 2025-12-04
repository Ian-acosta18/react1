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

    // ESTA ES LA FUNCIÓN QUE FALTABA
    public function servicios()
    {
        // Una categoría TIENE MUCHOS servicios
        return $this->hasMany(Servicio::class, 'categoria_id', 'id');
    }
}