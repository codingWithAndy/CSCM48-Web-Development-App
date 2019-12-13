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

        //$a = new BlogUser;

        //$a->first_name = "Andy";
        //$a->surname = "Gray";
        //$a->date_of_birth = "1987-12-24 00:00:00";
        //$a->save();

    }
}
