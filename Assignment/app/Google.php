<?php

namespace App;

use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class Google
{

    private $googleUserID;

    public function __construct($id)
    {
        $this->googleUserID = $id; //Auth::id();
        //dd($this->googleUserID, $id);
    }

}
