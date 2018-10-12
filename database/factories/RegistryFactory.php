<?php

use Faker\Generator as Faker;

$factory->define(App\Registry::class, function (Faker $faker) {
    return [
        'QR_code'=>null,
        'student_id'=>$faker->numberBetween(1,100),
        'vigilante'=>$faker->numberBetween(1,5),
        'tutor'=>$faker->numberBetween(6,100)
    ];
});
