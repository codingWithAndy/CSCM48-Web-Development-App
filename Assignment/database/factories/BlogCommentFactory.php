<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogComment;
use Faker\Generator as Faker;

$factory->define(BlogComment::class, function (Faker $faker) {
    return [
        //
        'comment_for_blog' => $faker->paragraph(1, true),
        'blog_post_id' => App\BlogPost::inRandomOrder()->first()->id, //$faker->randomFloat(0, 1, 40),
        'comment_user_id' => App\BlogUser::inRandomOrder()->first()->id, 
    ];
});
