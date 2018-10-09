<?php

use Faker\Generator as Faker;

$factory->define(App\Vigilant::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'second_last_name'=>$faker->lastName
    ];
});
