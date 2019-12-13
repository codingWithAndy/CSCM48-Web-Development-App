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
        //'user_profile_id' => App\BlogUser::id() //this has been changed.
    ];
});
