<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use App\Google;
use App;
Use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
Use Exception;

class SocialAuthGoogleController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        try {

            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('email', $googleUser->email)->first();

            if ($existUser) {

                Auth::loginUsingId($existUser->id, true);
                $g = app()->make('google');
                return redirect()->route('home');

            } else {

                $user = new User;
                $user->name = $googleUser->user['given_name'];
                $user->surname = $googleUser->user['family_name'];
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = md5(rand(1, 10000));

                $user->save();

                Auth::loginUsingId($user->id, true);
                $g = app()->make('google');
                return redirect()->route('bloguser.create');

            }

        } catch (Exception $e) {

            return redirect('/');
        }
    }
}
