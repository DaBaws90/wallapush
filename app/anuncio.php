<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class anuncio extends Model
{
    protected $table = 'anuncios';

    protected $fillable = ['producto', 'id_categoria', 'precio', 'nuevo', 'descripcion', 'id_vendedor'];
}
