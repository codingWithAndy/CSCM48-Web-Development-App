<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(BlogUserTableSeeder::class);
        $this->call(BlogPostTableSeeder::class);
        $this->call(BlogCommentTableSeeder::class);
        $this->call(TagTableSeeder::class);
    }
}
