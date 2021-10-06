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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'cesaeTeste@gmail.com',
            'password' => Hash::make('tXuEmsuPn7:CsQY'),
        ]);
    }
}
