<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        //
        'blog_title' => $faker->sentence(3, true),
        'blog_content' => $faker->paragraph(1, true),
        'blog_user_id' => App\BlogUser::inRandomOrder()->first()->id,
        /*'blog_tag' => function()
        {
            factory(App\Tag::class)->create()->id;
        }*/
    ];

});
