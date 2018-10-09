<?php

use Faker\Generator as Faker;

$factory->define(App\Expedient::class, function (Faker $faker) {
    return [
        'description',
        'detail_id'=>null
    ];
});
