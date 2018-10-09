<?php

use Faker\Generator as Faker;

$factory->define(App\Registry::class, function (Faker $faker) {
    return [
        'QR_code'=>null,
        'student_id'=>$faker->numberBetween(1,100),
        'tutor_id'=>$faker->numberBetween(1,100),
        'vigilant_id'=>$faker->numberBetween(1,3)
    ];
});
