<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        DB::table('streams')->truncate();
        DB::table('users')->truncate();
        DB::table('teachers')->truncate();
        DB::table('classes')->truncate();
        DB::table('students')->truncate();
        DB::table('years')->truncate();
        DB::table('terms')->truncate();
        DB::table('subjects')->truncate();
        DB::table('exams')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('years')->insert(['name' => now()->yearIso]);

        factory(\App\Subject::class, 2)->create();
        factory(\App\Stream::class, 2)->create();
        factory(\App\User::class)->create();
        factory(\App\Teacher::class, 10)->create();
        factory(\App\Classes::class, 2)->create();
        factory(\App\Student::class, 30)->create();
        factory(\App\Term::class, 10)->create();
        factory(\App\Exam::class, 10)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
