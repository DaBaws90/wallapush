<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\categoria;
use App\User;
use App\Transaction;
use App\image;

class anuncio extends Model
{
    protected $table = 'anuncios';

    protected $fillable = ['producto', 'id_categoria', 'precio', 'nuevo', 'descripcion', 'id_vendedor'];

    public function categoria(){
        return $this->belongsTo(categoria::class, 'id_categoria');
    }

    public function vendedor(){
        return $this->belongsTo(User::class, 'id_vendedor');
    }

    public function transaccion(){
        return $this->hasOne(Transaction::class, 'id_anuncio');
    }
    
    public function images() {
        return $this->hasMany(image::class, 'id_anuncio');
    }

    public function image() {
        // dd($this->hasMany(image::class, 'id_anuncio')->limit(1));
        // return $this->hasMany(image::class, 'id_anuncio')->limit(1);
        // return $this->hasOne(image::class, 'id_anuncio');
        // $images = image::where('id_anuncio', $this->id);
        // return image::all()->paginate(1);  
        $image = $this->images()->first();
        return $image;
    }

    public function isOwner() {
        return $this->id_vendedor === auth()->id();
    }
}
