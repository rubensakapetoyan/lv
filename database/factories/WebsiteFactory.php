<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Website;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Website::class, function (Faker $faker) {
    return [
        'link' => 'http://'. Str::random(5) .'.com',
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now'),
    ];
});

