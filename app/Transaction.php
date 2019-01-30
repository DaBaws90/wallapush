<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\anuncio;
use App\User;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = ['valoracion'];

    public function anuncion(){
        return $this->belongsTo(anuncio::class, 'id_anuncio');
    }

    public function comprador(){
        return $this->belongsTo(User::class, 'id_comprador');
    }

    // public function vendedor(){}
}
