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

$factory->define(App\Highscore::class, function (Faker $faker) {

    return [
        'fname' => $faker->firstName(),
        'lname' => $faker->lastName,
        'score' => $faker->numberBetween($min = 1000, $max = 9000),
        'approved' => 0,
        'd_id' => 1
    ];
});
