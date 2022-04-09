<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class projectController extends Controller
{
    public function all_projects(Request $request)
    {
        $allproject = project::query()->with('comments', 'user')->orderBy('created_at', 'DESC');
        if ($request->search)
            $allproject = project::with('comments', 'user')
                ->where('des', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'DESC');
        if ($request->status)
            $allproject = $allproject->whereIn('user.status', explode(',', $request->status));
        if ($request->min_price)
            $allproject = $allproject->where('min_price', '>=', $request->min_price);
        if ($request->max_price)
            $allproject = $allproject->where('min_price', '<=', $request->max_price);
        if ($request->country)
            $allproject = $allproject->where('user.country', $request->country);

        // dd($allproject->toSql(), $allproject->getBindings());

        foreach ($allproject as $project) {
            $project->my_date = $project->created_at->diffForHumans()->get();
        }
        return $allproject->get();
        return $allproject->paginate(30);
        $min_price = project::orderBy('min_price')->first();
        $max_price = project::orderBy('min_price', 'DESC')->first();
        return $all_data = [
            'min_price'     => $min_price->min_price,
            'max_price'     => $max_price->min_price,
            'all_projects'  =>  $allproject->paginate(30)
        ];
    }

    public function project($project_id)
    {
        $project = project::with('user')->find($project_id);
        $user_id = auth::id();
        $comment_count = DB::select("SELECT * FROM comments WHERE project_id = $project_id AND `user_id` = $user_id");

        if (count($comment_count) >= 1) {
            $project->comment_status =  false;
        }

        $project->my_date = $project->created_at->diffForHumans();

        $comments = comment::with('user')->where('project_id', $project_id)->get();

        if ($project) {
            return view('home.project', compact('project', 'comments'));
        } else {
            return redirect()->route('home');
        }
    }

    public function new_project(Request $request)
    {
        return view('home.project.new_project');
    }

    public function create(request $request)
    {
        $request->validate([
            'name'      => 'required|max:100',
            'des'       => 'required|max:10000',
            'min_price' => 'required|max:10000000|min:1|numeric',
            'tags'      => 'max:200|min:3',
        ]);
        $project = new project;
        if ($request->has('image')) {
            $request->validate([
                'image'     => 'required|mimes:jpeg,jpg,png,gif|file|max:2000|dimensions:min_width=100,min_height=200',
            ]);

            $image = $request->file('image');
            $filename = time() . rand(0, 999999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/project'), $filename);
            $project->image = $filename;
            $project->update();
        }
        $project->name          = $request->name;
        $project->des           = $request->des;
        $project->min_price     = $request->min_price;
        $project->tags          = str_replace(' ', '', $request->tags);
        $project->user_id       = auth::id();
        $project->save();

        return redirect()->route('home')->with('success', 'Add a new project by you');
    }

    public function edit($project_id)
    {
        $project = project::find($project_id);

        if ($project) {
            if ($project->user_id == auth::id()) {
                return view('home.project.edit', compact('project'));
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong, try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong, try again');
        }
    }

    public function update(Request $request, $project_id)
    {
        $project = project::find($project_id);
        if ($project) {
            if ($project->user_id == auth::id()) {
                $request->validate([
                    'name'      => 'required|max:100',
                    'des'       => 'required|max:10000',
                    'min_price' => 'required|max:10000000|min:1|numeric',
                    'tags'      => 'max:200|min:3',
                ]);
                $project->update([
                    'name'      => $request->name,
                    'des'       => $request->des,
                    'min_price' => $request->min_price,
                    'tags'      => str_replace(' ', '', $request->tags),
                ]);

                if ($request->image) {

                    if ($project->image != null) {
                        if (is_file(public_path("img\project\\") . $project->image)) {
                            $file_name = public_path("img\project\\") . $project->image;
                            unlink($file_name);
                        }
                    }
                    $image = $request->file('image');
                    $filename2 = time() . rand(0, 999999999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('img/project'), $filename2);
                    $project->image = $filename2;
                    $project->update();
                }
                return redirect()->route('project', $project->id)->with('success', 'You have added a modification to the project');
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong, try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong, try again');
        }
    }

    public function delete($project_id)
    {
        $project = project::find($project_id);

        if ($project) {
            if ($project->user_id == auth::id()) {
                $project->delete();
                return redirect()->route('home')->with('success', 'You have deleted the project');
            } else {
                return redirect()->route('home')->with('error', 'Something went wrong, try again');
            }
        } else {
            return redirect()->route('home')->with('error', 'Something went wrong, try again');
        }
    }
}
