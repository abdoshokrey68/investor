<?php

namespace App\Http\Controllers;

use App\Events\commentNotice;
use App\Models\comment;
use App\Models\notice;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{

    public function index(request $request, $project_id)
    {
        $project = project::find($project_id);
        event(new commentNotice($project));
        if ($project) {
            $request->validate([
                'comment'   => 'required|min:100|max:1000',
                'status'    => 'required|integer|between:1,2',
            ]);
            comment::create([
                'comment'       => $request->comment,
                'status'        => $request->status,
                'date'          => date('Y-m-d'),
                'user_id'       => Auth::id(),
                'project_id'    => $project_id,
            ]);
            notice::create([
                'des_ar'        => ' قام شخص بالتعليق علي مشروعك ',
                'des_en'        => 'Someone has commented on your project',
                'user_id'       => $project->user_id,
                'manage_id'     => Auth::id(),
                'project_id'    => $project_id,
            ]);
            $request->session()->flash('success', 'I have left a suggestion on this project');
            return redirect()->back();
        } else {
            $request->session()->flash('error', ' This Project Not Found');
            return redirect()->back();
        }
    }

    public function edit($project_id)
    {
        $project = project::find($project_id);
        $comment = comment::with('user')->where('project_id', $project_id)->where('user_id', Auth::id())->first();
        if ($project) {

            if ($comment) {
                if ($comment->user_id == auth::id()) {
                    return view('home.comment.edit', compact('comment', 'project'));
                } else {
                    return redirect()->route('home')->with('error', 'Something went wrong. Try again');
                }
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong. Try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong. Try again');
        } // End Of This Project Is Set
    }

    public function update(Request $request, $project_id)
    {
        $project = project::find($project_id);
        $comment = comment::with('user')->where('project_id', $project_id)->where('user_id', Auth::id())->first();
        if ($project) {
            if ($comment) {
                if ($comment->user_id == auth::id()) {
                    $request->validate([
                        'comment'   => 'required|string|min:100|max:1000',
                        'status'    => 'required|integer|between:1,2',
                    ]);
                    $comment->update([
                        'comment'   => $request->comment,
                        'status'    => $request->status
                    ]);
                    return redirect()->route('project', $project_id)->with('success', 'Comment has been modified successfully');
                } else {
                    return redirect()->route('home')->with('error', 'Something went wrong. Try again');
                }
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong. Try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong. Try again');
        } // End Of This Project Is Set
    }


    public function delete($project_id)
    {
        $project = project::find($project_id);
        $comment = comment::with('user')->where('project_id', $project_id)->where('user_id', Auth::id())->first();
        if ($project) {
            if ($comment) {
                if ($comment->user_id == auth::id()) {
                    $comment->delete();
                    return redirect()->route('project', $project_id)->with('success', 'Comment has been Deleted successfully');
                } else {
                    return redirect()->route('home')->with('error', 'Something went wrong. Try again');
                }
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong. Try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong. Try again');
        } // End Of This Project Is Set

    }
}
