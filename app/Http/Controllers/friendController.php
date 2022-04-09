<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class friendController extends Controller
{

    public function index () {
        $user_id = Auth::user();
        $friend = friend::with('user')->where('user_id', 1)->get();
        return $friend;
    }

    public function add_friend (request $request, $friend_id) {

        $friend_id = $friend_id;
        $user_id = Auth::id();

        $test_friend = DB::select("SELECT * FROM friends where `user_id` = $user_id AND  `friend_id` = $friend_id");
        if (empty($test_friend)) {
            friend::create([
                'user_id'   => $user_id,
                'friend_id' => $friend_id,
            ]);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function remove_friend ($friend_id) {
        $friend = friend::where(['user_id'=> 1,'friend_id'=> $friend_id])->limit(1)->get();
        $friend[0]->delete();
        return redirect()->back();
    }

    public function accept_request ($friend_id) {
        $friend = User::find($friend_id);
        $user_id = Auth::id();
        return $user_id;
        if ($friend) {
            $check_friends_list = DB::select("SELECT * FROM friends ");
        } else {
            return redirect()->route('home')->with('error', 'A problem happened . Try later');
        }
    }


}
