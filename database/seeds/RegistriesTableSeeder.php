<?php

use Illuminate\Database\Seeder;

class RegistriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Registry::class,50)->create();
    }
}
