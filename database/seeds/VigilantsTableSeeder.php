<?php

use Illuminate\Database\Seeder;

class VigilantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Vigilant::class,100)->create();
    }
}
