<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AboutUser;
use App\Project;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $aboutUser = AboutUser::first(['about', 'experience']);
        return view('welcome', compact('aboutUser'));
    }

    public function projects()
    {
        $projects = Project::where('is_archived', '=', 'false')
            ->latest()->get();
        // return $projects;
        return view('fe.home.projects', compact('projects'));
    }

    public function aboutUser()
    {
        $about_res = DB::select('select u.id,u.email,u.fname,u.lname, au.about, au.git_url, au.experience
                                from users u inner join about_users au
                                on u.id = au.user_id');

        $about_res =  json_decode(json_encode($about_res), true);
        $result = $about_res[0];
        return view('fe.home.about', compact('result'));
    }
}
