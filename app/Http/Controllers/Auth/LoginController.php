<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm ($user_id = null)
    {
        if ($user_id && is_numeric($user_id)) {
            $this->createCookies($user_id);
        }
        return view('auth.login');
    }

    public function createCookies ($user_id)
    {
        $endcookie = time() + ( 24 * 60 * 60 );
        setcookie('belongsTo', $user_id, $endcookie, '/');
        setcookie('redirectTo', 1, $endcookie, '/');
    }
}
