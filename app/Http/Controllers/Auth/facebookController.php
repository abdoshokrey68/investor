<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;

class facebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/home');
            }else{
                $user_email = $user->email;
                if (empty($user_email)) {
                    $user_email = $user->id.'@gmail.com';
                }
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user_email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
