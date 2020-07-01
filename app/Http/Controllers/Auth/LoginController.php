<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Two\InvalidStateException;
use JWTAuth;
use App\Models\User;
use App\Models\UserSocial;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /* protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    } */

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        Session::put('redirect', $request->url);
        Session::put('locale', $request->locale);
        return Socialite::driver('twitch')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        //dd($user);
        // $user->token;
        try {
            $serviceUser = Socialite::driver('twitch')->stateless()->user();
        } catch (\Exception $e) {
            return redirect(env('APP_URL') . '/' . Session::get('locale') . '/auth/social-callback?error=Unable to login using. Please try again&redirect=' . Session::get('redirect'));
        }


        $email = $serviceUser->getEmail();

        $user = $this->getExistingUser($serviceUser, $email);
        if (!$user) {
            $user = User::create([
                'name' => $serviceUser->getName(),
                'email' => $email,
                'password' => '',
                'avatar' => $serviceUser->avatar
            ]);
            UserSocial::create([
                'user_id' => $user->id,
                'social_id' => $serviceUser->getId()
            ]);
        }
        $token = JWTAuth::fromUser($user);
        return redirect(env('APP_URL') . '/' . Session::get('locale') . '/auth/social-callback?token=' . $token . '&redirect=' . Session::get('redirect'));

        Session::forget('redirect');
    }

    public function getExistingUser($serviceUser, $email)
    {
        return User::where('email', $email)->orWhereHas('social', function ($q) use ($serviceUser) {
            $q->where('social_id', $serviceUser->getId());
        })->first();
    }
}
