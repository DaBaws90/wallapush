<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'id_anuncio' => $faker->unique()->numberBetween(1,50),
        'id_comprador' => \App\User::all()->random()->id,
        'valoracion' => $faker->numberBetween(1,5),
    ];
});
