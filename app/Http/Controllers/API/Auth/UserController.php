<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\UserSocial;

class UserController extends Controller
{

    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbW9pLmVscmVjby5mclwvbG9naW5cL3R3aXRjaFwvY2FsbGJhY2siLCJpYXQiOjE1OTM2MDk2NjYsImV4cCI6MTU5MzYxMzI2NiwibmJmIjoxNTkzNjA5NjY2LCJqdGkiOiJBa0tzd05xellHdm45dldkIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.yY5TroGxvae60USWJjiCPq8OKDK8vEM4hh3OXNFsYUw';
        $token = $request->token;
        $this->auth->setToken($token);
        $user = $this->auth->authenticate();

        return $user;
    }
}
