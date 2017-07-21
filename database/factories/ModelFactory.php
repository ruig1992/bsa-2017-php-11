<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entity\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'is_admin' => false,
    ];
});

$factory->define(App\Entity\Car::class, function (Faker\Generator $faker) {
    return [
        'color' => $faker->colorName,
        'model' => $faker->name,
        'registration_number' => str_random(6),
        'year' => $faker->year,
        'mileage' => $faker->randomDigit,
        'price' => $faker->randomDigit,
        'user_id' => 1,
    ];
});
