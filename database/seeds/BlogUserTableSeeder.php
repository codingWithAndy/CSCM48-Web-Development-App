<?php

use Illuminate\Database\Seeder;
use App\BlogUser;

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
