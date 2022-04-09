<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\message;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index () {
        return view('admin.index');
    }

    public function messages () {
        $messages = message::paginate(20);
        return view('admin.messages', compact('messages'));
    }

    public function users () {
        return view('admin.users');
    }

    public function users_api ()
    {
        $users = User::with('comments', 'projects')->orderBy('coins', 'DESC')->paginate(300);
        return response()->json($users);
    }

    public function projects ()
    {
        return view('admin.projects');
    }

    public function projects_api ()
    {
        $projects = project::with('comments', 'user')->orderBy('created_at', 'DESC')->paginate(300);
        return $projects;
    }

    public function comments ()
    {
        return view('admin.comments');
    }

    public function comments_api ()
    {
        $comments = comment::with('project', 'user')->orderBy('created_at', 'DESC')->paginate(300);
        return $comments;
    }

    public function belongsto_api ($user_id) {

        $users = User::where('belongs_to', $user_id)->get();

        return $users;
    }

}
