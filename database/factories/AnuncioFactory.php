<?php

use Faker\Generator as Faker;

$factory->define(App\anuncio::class, function (Faker $faker) {
    return [
        'producto' => $faker->word,
        'id_categoria' => \App\Categoria::all()->random()->id,
        'precio' => $faker->numberBetween(1,25),
        'nuevo' => true,
        'descripcion' => $faker->text(500, 1000),
        'id_vendedor' => \App\User::all()->random()->id,
        'vendido' => rand(0, 1),
        'created_at' => $faker->dateTimeThisYear('now'),
    ];
});
