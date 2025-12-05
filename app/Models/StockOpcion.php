<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpcion extends Model
{
    use HasFactory;

    // Nombre de la tabla que creamos en el paso 1
    protected $table = 'stock_opciones';
    
    protected $fillable = ['cantidad'];
}