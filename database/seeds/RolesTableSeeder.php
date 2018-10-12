<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'type'=>'Administrador'
        ]);
        App\Role::create([
            'type'=>'Tutor_sustituto'
        ]);
        App\Role::create([
            'type'=>'Padre'
        ]);
        App\Role::create([
            'type'=>'Guardia'
        ]);
    }
}
