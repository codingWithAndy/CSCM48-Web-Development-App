<?php

use Illuminate\Database\Seeder;
use App\BlogPost;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = factory(App\BlogPost::class, 50)->create();
        $tags = factory(App\Tag::class, 5)->create();

        
        App\BlogPost::all()->each(function ($post) use ($tags){
            
                $post->blogTags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()

                );
        });

        dd($tags);

        
    }
}


/*

App\BlogPost::all()->each(function ($post) use ($tags){
            for ($x = 0; $x < 4; $x++) {
                $post->blogTags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()

                );
            }
            

        });

        */