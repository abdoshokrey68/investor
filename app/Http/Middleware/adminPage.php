<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminPage
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(Auth::id());
        if ($user->status == 4) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
