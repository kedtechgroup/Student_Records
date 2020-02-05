<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(\App\Classes::class, function (Faker $faker) {
    return [
        'name'             => $faker->name,
//        'ClassNameNumeric' => '1',
//        'section'          => 'section',
        'teacher_id'       => \App\Teacher::query()->inRandomOrder()->first()->id,
        'stream_id'        => \App\Stream::query()->inRandomOrder()->first()->id,
    ];
});
