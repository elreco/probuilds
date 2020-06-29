<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        Session::put('redirect', $request->url);
        return Socialite::driver('twitch')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitch')->stateless()->user();
        //dd($user);
        // $user->token;
        return redirect(Session::get('redirect'));
        Session::forget('redirect');
    }
}
