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

    // Relación: Una categoría tiene muchos servicios
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'categoria_id', 'id');
    }
}