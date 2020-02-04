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
        factory(\App\Stream::class, 2)->create();
        factory(\App\User::class)->create();
        factory(\App\Teacher::class, 10)->create();
        factory(\App\Classes::class, 2)->create();
        factory(\App\Student::class, 10)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
