<?php

namespace App;

use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class Google
{

    private $googleUser;

    public function __construct($token)
    {

        //$this->$token = ;
        //dd($googleUser);
    }


    //$googleUser = Socialite::driver('google')->user(); //->stateless() { Might be able to stick this behind a singleton function}
    //$existUser = User::where('email', $googleUser->email)->first();




}
