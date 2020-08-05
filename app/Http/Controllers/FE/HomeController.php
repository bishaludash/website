<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AboutUser;
use App\Project;
use App\Traits\DBUtils;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use DBUtils;

    public function home()
    {
        $aboutUser = AboutUser::first(['about', 'experience']);
        return view('welcome', compact('aboutUser'));
    }

    public function projects()
    {
        $query = "select p.project_title, p.project_body, p.project_url, x.images
            from projects p left join(
            select foreign_id ,string_agg(image_path,',') as images from image_managers im 
            where source ='projects' group by im.foreign_id
        ) x on p.id = x.foreign_id
        where p.is_archived = 'f' 
        order by created_at desc";
        $projects = $this->selectQuery($query);
        foreach ($projects as $key => $item) {
            $projects[$key]['images'] = explode(",", $projects[$key]['images']);
        }
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
