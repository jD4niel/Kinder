<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(TutorsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(VigilantsTableSeeder::class);
        $this->call(RegistriesTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
    }
}
