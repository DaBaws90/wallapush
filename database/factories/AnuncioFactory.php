<?php

use Faker\Generator as Faker;

$factory->define(App\anuncio::class, function (Faker $faker) {
    return [
        'producto' => $faker->word,
        'id_categoria' => \App\Categoria::all()->random()->id,
        'precio' => $faker->numberBetween(1,200),
        'nuevo' => true,
        'descripcion' => $faker->sentence,
        'id_vendedor' => \App\User::all()->random()->id,
        'vendido' => false,
    ];
});
