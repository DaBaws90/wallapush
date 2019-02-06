<?php

use Faker\Generator as Faker;

$factory->define(App\categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->randomElement([
            'Coches',
            'Inmobiliaria',
            'Motos',
            'Motor y Accesorios',
            'TV, Audio y Foto',
            'Móviles y Telefonía',
            'Informática y Electrónica',
            'Deporte y Ocio',
            'Bicicletas',
            'Consolas y Videojuegos',
            'Hogar y Jardín',
            'Moda y Accesorios',
            'Electrodomésticos',
            'Cine, Libros y Música',
            'Niños y Bebés',
            'Coleccionismo',
            'Construcción y Reformas',
            'Industria y Agricultura',
            'Servicios',
            'Otros',
        ]),
    ];
});
