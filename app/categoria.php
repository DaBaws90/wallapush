<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\anuncio;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nombre'];

    public function anuncios(){
        return $this->hasMany(anuncio::class, 'id_categoria');
    }

}
