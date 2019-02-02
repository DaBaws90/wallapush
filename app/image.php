<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\anuncio;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['id_anuncio', 'img'];

    public function anuncio(){
        return $this->belongsTo(anuncio::class, 'id_anuncio');
    }
}
