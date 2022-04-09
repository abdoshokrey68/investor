<?php

namespace App\Http\Controllers;

use App\Models\friend;
use App\Models\notice;
use App\Models\project;
use App\Models\rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index ($user_id)
    {
        $user = User::with('projects','comments')->orderBy('created_at', 'DESC')->find($user_id);

        $projects = project::with('comments', 'user')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        foreach ($projects as $project) {
            $project->my_date = $project->created_at->diffForHumans();
        }
        if ($user) {
            return view('home.profile', compact('user', 'projects'));
        } else {
            session()->flash('error', 'This Page Not Found');
            return redirect()->route('home');
        }
    }

    public function edit ($user_id)
    {
        $countrys = file_get_contents(public_path('include\countrys.json'));
        $user = User::find($user_id);
        if ($user->id == Auth::id()) {
            return view('home.profile.edit', compact('user', 'countrys'));
        } else {
            return redirect()->route('profile',$user_id);
        }
    }

    public function update (request $request, $user_id)
    {
        // return dd($request->all());
        $user = User::find($user_id);

        $request->validate([
            'name'      => 'required|max:40',
            'email'     => 'required|max:50|email:rfc,dns|unique:users,email,'.$user_id,
            'status'    => 'required|max:3',
            'country'   => 'max:100',
            'phone'     => 'required|max:30',
            'bio'       => 'max:20000'
        ]);

        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'status'        => $request->status,
            'country'       => $request->country,
            'phone'         => $request->phone,
            'bio'           => $request->bio,
        ]);

        notice::create([
            'des_ar'       => ' تعديل بياناتك يساعد الاشخاص علي سهولة الوصول إليك ',
            'des_en'       => 'Modifying your data helps people easily reach you',
            'user_id'   => Auth::id(),
            'manage_id'   => Auth::id(),
        ]);

        if ($request->password) {
            $request->validate([
                'password'  => 'min:8,max:150',
            ]);
            $user->update([
                'password'  => $request->password
            ]);
        }

        // return public_path("img\users\\"). $user->image;

        if($request->has('image')) {
            $request->validate([
                'image'     => 'required|mimes:jpeg,jpg,png,gif|file|max:2000|dimensions:min_width=100,min_height=200',
            ]);

            // if ($user->image != 'users.png') {
            //     if (is_file(public_path("img\users\\"). $user->image))
            //             // return 'done';
            //         $file_name = public_path("img\users\\"). $user->image;
            //         unlink($file_name,);
            //         $user->image = 'users.png';
            //         $user->update();
            // }
            $image = $request->file('image');
            $filename = time(). rand(0, 999999999) .'.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/users'), $filename);
            $user->image = $filename;
        }
        $user->update();
        return redirect()->back()->with('success', 'The data has been successfully updated');
    }

    public function get_rate () {
        // rating_total => حساب مجموع التقييمات كاملة
        // all_ratings => جميع التقييمات
        // rating_count => عدد التقييمات
        $user_id = 2;
        $all_ratings = rating::where('user_id', $user_id)->get();
        $rating_count = count($all_ratings);
        $rating_total = 0;
        foreach ($all_ratings as $rate) {
            $rating_total = $rating_total + $rate->user_rate;
        }

        $the_reat = round( $rating_total / $rating_count );

        // $percent = round( ( ($rating_total / (( $rating_count * 5 ) / 100 ) / 100) / 2) );
        return $rating_total;
    }
}
