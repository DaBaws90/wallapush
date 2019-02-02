<?php

use Faker\Generator as Faker;

$factory->define(App\image::class, function (Faker $faker) {
    return [
        'id_anuncio' => \App\anuncio::all()->random()->id,
        'img' => \Faker\Provider\Image::image(storage_path() . '\app\public\anuncios', 200, 200, 'technics', False),
    ];
});
