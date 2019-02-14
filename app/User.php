<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Transaction;
use App\anuncio;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'localidad',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transacciones(){
        return $this->hasMany(Transaction::class, 'id_comprador');
    }

    public function anuncios(){
        return $this->hasMany(anuncio::class, 'id_vendedor');
    }

    public function sold() {
        return $this->hasMany(anuncio::class, 'id_vendedor')->where('vendido', true);
    }
}
