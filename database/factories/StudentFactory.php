<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'second_last_name'=>$faker->lastName,
        'group'=>$faker->randomElement(['A','B','C','D','E']),
        'degree'=>$faker->numberBetween(1,3),
        'credential_id'=>null,
        'expedient_id'=>null
    ];
});
