<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogUser;
use Faker\Generator as Faker;

$factory->define(BlogUser::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user_id' => App\User::inRandomOrder()->first()->id,

    ];
});
