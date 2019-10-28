<?php

use Illuminate\Database\Seeder;

class BlogUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\BlogUser::class, 50)->create();
    }
}
