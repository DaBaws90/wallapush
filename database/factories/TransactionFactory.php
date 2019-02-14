<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {

    return [
        'id_anuncio' => function () {
            $anuncio = \App\anuncio::find(\App\anuncio::where('vendido', false)->get()->random()->id);
            $anuncio->vendido = true;
            $anuncio->save();
            return $anuncio->id;
        },
        'id_comprador' => \App\User::all()->random()->id,
        'valoracion' => $faker->numberBetween(1, 5),
    ];
});
