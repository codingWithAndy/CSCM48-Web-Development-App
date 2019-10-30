<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogComment;
use Faker\Generator as Faker;

$factory->define(BlogComment::class, function (Faker $faker) {
    return [
        //
        'blog_comment' => $faker->paragraph(1, true),
        'blog_id' => $faker->randomFloat(0, 1, 40),
    ];
});
