<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Traits\ImageHandler;

class ProjectsController extends Controller
{
    use ImageHandler;
    public $image_bucket = 'projects';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('backend.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_title' => 'required|min:5',
            'project_body' => 'required',
        ],[
            'project_body.required'=>'Project details feild is required'
        ]);
            
        $input = $request->all();
        // validate and upload image, if false flash message. Used Trait
        if ($request->hasFile('project_image')){
            $input['project_image']=$this->uploadImage($input, 'project_image',$this->image_bucket );
            if ($input['project_image'] == false) {
                return back()->withInput();
            }
        }
        
        if (!Project::create($input)) {
            session()->flash('message_danger', 'Project could not be created.');
        }
        session()->flash('message_success', 'Project created.');
        return back();
    }
    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        return view('backend.projects.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }
}
