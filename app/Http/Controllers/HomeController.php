<?php

namespace App\Http\Controllers;

use App\Events\commentNotice;
use App\Models\comment;
use App\Models\follower;
use App\Models\message;
use App\Models\notice;
use Illuminate\Http\Request;
use App\Models\project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use shokrey\shokreyProvider\shokrey;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cookieSetting()
    {
        $check = 0;
        if (isset($_COOKIE['redirectTo'])) {
            return $check = $_COOKIE['redirectTo'];
        }
    }

    public function index()
    {
        $check = $this->cookieSetting();
        if ($check == 1) {
            $user_id = $_COOKIE['belongsTo'];
            setcookie('redirectTo', 0);
            return redirect()->route('work_with_us', $user_id);
        }
        $all_project = project::with('user')->orderBy('created_at', 'DESC')->get();
        foreach ($all_project as $project) {
            $project->my_date = $project->created_at->diffForHumans();
        }
        $user = User::with('notices')->find(Auth::id());
        return view('home', compact('all_project'));
    }

    public function work_with_us($user_id)
    {
        $user = User::find($user_id);
        if ($user && $user->sub == 1) {
            session()->flash('key', 'This page is not available');
            return view('home.work', compact('user'));
        } else {
            $member = User::find(Auth::id());
            if ($member->sub == 1) {
                return redirect()->route('work_with_us', Auth::id());
            } else {
                return redirect()->route('subscribe', $user->id);
            }
        }
    }

    public function subscribe($user_id)
    {
        $user = User::find($user_id);
        $member = User::find(Auth::id());
        if ($member->sub == 1) {
            return redirect()->route('work_with_us', Auth::id());
        } else {
            if ($user->sub == 1) {
                return view('home.subscribe', compact('user'));
            } else {
                $user = User::find(Auth::id());
                return view('home.subscribe', compact('user'));
            }
        }
    }

    public function subscribe_now($belongs_to)
    {
        $user_id    = auth::id();
        $user       = User::find($user_id);
        if ($user->sub == 0) {
            if ($belongs_to == $user_id) {
                $belongs_to = 0;
            } else {
                $member_belong = User::find($belongs_to);
                if ($member_belong) {
                    $belongs_to;
                    $member_belong->update([
                        'coins'     => $member_belong->coins + 50
                    ]);

                    $member2 = User::find($member_belong->belongs_to);
                    // جلب المستخدم التابع لهذا المستخدم و التحقق منه للأستطاعة من ارسال مستحقاته
                    if ($member2) {
                        $member2->update([
                            'coins'     => $member2->coins + 20
                        ]);
                        $des_ar = " قام مستخدم جديد بالتسجيل وتمت إضافة 20 دولارًا أمريكيًا إلى حسابك ";
                        $des_en = "A new user has signed up and $ 20 has been added to your account";
                        $this->create_notice($des_ar, $des_en, $member2->id, $user_id);

                        $member3 = User::find($member2->belongs_to);
                        if ($member3) {
                            $member3->update([
                                'coins'     => $member3->coins + 10
                            ]);
                            $des_ar = " قام مستخدم جديد بالتسجيل وتمت إضافة 10 دولارات إلى حسابك ";
                            $des_en = "A new user has signed up and $ 10 has been added to your account";
                            $this->create_notice($des_ar, $des_en, $member3->id, $user_id);

                            $member4 = User::find($member3->belongs_to);
                            if ($member4) {
                                $member4->update([
                                    'coins'     => $member4->coins + 10
                                ]);
                                $des_ar = " قام مستخدم جديد بالتسجيل وتمت إضافة 10 دولارات إلى حسابك ";
                                $des_en = "A new user has signed up and $ 10 has been added to your account";
                                $this->create_notice($des_ar, $des_en, $member4->id, $user_id);

                                $member5 = User::find($member4->belongs_to);
                                if ($member5) {
                                    $member5->update([
                                        'coins'     => $member5->coins + 10
                                    ]);
                                    $des_ar = " قام مستخدم جديد بالتسجيل وتمت إضافة 10 دولارات إلى حسابك ";
                                    $des_en = "A new user has signed up and $ 10 has been added to your account";
                                    $this->create_notice($des_ar, $des_en, $member5->id, $user_id);
                                }
                            }
                        }
                    }
                } else {
                    $belongs_to = 0;
                }
            }

            $user->update([
                'belongs_to'    => $belongs_to,
                'sub'           => 1
            ]);

            $des_ar = ' لقد اشتركت بنظام العمل معنا ';
            $des_en = 'You have subscribed to our work system';
            $this->create_notice($des_ar, $des_en, $user_id, $user_id);


            $des_ar = "$user->name لقد اشترك معنا بواسطتك";
            $des_en = "$user->name has subscribed to us by you";
            $this->create_notice($des_ar, $des_en, $belongs_to, $user_id);

            session()->flash('success', 'You have subscribed with us now');
            return redirect()->route('work_with_us', $user_id);
        } else {
            session()->flash('error', 'Something went wrong, try again');
            return redirect()->route('work_with_us', $user_id);
        }
    }

    public function get_notice(Request $request)
    {
        if (isset($request->owner) && $request->owner == 'shokrey') {
            $user_id = Auth::id();
            $notice = notice::find(auth::id());
            $notice = DB::select("SELECT * FROM notices WHERE user_id = $user_id ORDER BY `date` DESC");
            $notice_show = DB::select("SELECT * FROM notices WHERE user_id = $user_id AND `show` = 0");
            if ($notice) {
                return $data = (['status' => 'success', 'data' => $notice, 'notice_show' => $notice_show]);
            } else {
                return $data = (['status' => 'error', 'data' => NULL]);
            }
        }
    }

    public function update_notice($notice_id)
    {
        $notice = notice::find($notice_id);
        if ($notice->user_id == auth::id()) {
            if ($notice) {
                $notice->update([
                    'show'  => 1
                ]);
            }
        } else {
            return redirect()->route('home');
        }
    }

    // public function onlone_status (Request $request) {
    //     $user_id = Auth::id();
    //     $user = User::find($user_id);

    //     if ($request->status == 'online') {
    //         $user->update([
    //             'online_status'        => 1
    //         ]);

    //     } else {
    //         $user->update([
    //             'online_status'        => 0
    //         ]);
    //     }

    //     // return $request;
    //     return $user;
    // }

    public function followers($user_id)
    {
        // $test = follower::where(['followers_id'=> '1']);
        $followers_project = follower::with('user', 'projects')->where('user_id', Auth::id())->get();
        // return $followers_project;
        return view('home.followers', compact('followers_project'));
    }

    public function about_us()
    {
        return view('about_us');
    }

    public function contact_us()
    {
        return view('contact_us');
    }

    public function send_message(request $request)
    {
        $request->validate([
            'name'      => 'required|max:100',
            'email'     => 'required|max:150',
            'message'   => 'required|min:10|max:10000',
        ]);

        message::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'message'   => $request->message,
            // 'user_id'   => 1
        ]);

        return redirect()->route('home')->with('success', 'We have received your message and we thank you for contacting us');
    }

    public function create_notice($des_ar, $des_en, $user_id, $manage_id = 0)
    {
        notice::create([
            'des_ar'       => $des_ar,
            'des_en'       => $des_en,
            'user_id'   => $user_id,
            'manage_id' => $manage_id,
        ]);
    }
}
