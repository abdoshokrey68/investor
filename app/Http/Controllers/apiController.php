<?php

namespace App\Http\Controllers;

use App\Models\notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class apiController extends Controller
{
    public function notice ($user_id)
    {
        $notices = notice::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $locale = app()->getlocale();
        foreach ($notices as $notice ) {
            $notice->my_date = $notice->created_at->diffForHumans();
        }
        return $notices;
    }

    public function countrys()
    {
        $countrys = file_get_contents(public_path('include\countrys.json'));
        // $countrys = file_get_contents('http://vocab.nic.in/rest.php/country/json');
        return $countrys;
    }
}
