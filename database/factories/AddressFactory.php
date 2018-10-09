<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'postal_code' => $faker->numberBetween(42000,42300),
        'street'=> $faker->streetName,
        'colony'=> $faker->citySuffix,
        'municipality'=> $faker->randomElement(['Mineral de la Reforma','Pachuca']),
        'state'=> 'Hidalgo'
    ];
});
