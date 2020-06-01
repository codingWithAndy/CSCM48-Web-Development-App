<?php

use Illuminate\Database\Seeder;
use App\BlogComment;

class BlogCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\BlogComment::class, 50)->create();
    }
}
