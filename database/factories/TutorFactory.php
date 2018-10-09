<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Tutor::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'second_last_name'=>$faker->lastName,
        'phone_number'=>$faker->phoneNumber,
        'email'=> $faker->unique()->safeEmail,
        'password'=>'secret',
        'role_id'=>$faker->numberBetween(1,3),
        'address_id'=>$faker->numberBetween(1,100)

   /*     'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),*/
    ];
});
