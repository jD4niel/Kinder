<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'num_ext' => $faker->numberBetween(2,80),
        'street'=> $faker->streetName,
        'colony_id'=> $faker->numberBetween(1,50)
    ];
});
