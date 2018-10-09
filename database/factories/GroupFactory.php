<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'group'=>$faker->randomElement(['A','B','C','D','E','F']),
        'degree'=>$faker->numberBetween(1,3)
    ];
});
