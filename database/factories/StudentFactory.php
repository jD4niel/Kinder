<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'second_last_name'=>$faker->lastName,
        'credential_id'=>null,
        'group_id'=>$faker->unique()->numberBetween(1,100),
        'expedient_id'=>null
    ];
});
