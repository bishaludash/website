<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\Utils\ImageHandler;
use App\Project;

class ProjectsController extends Controller
{
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
            'project_title' => 'required',
            'project_body' => 'required',
        ],[
            'project_body.required'=>'Project details feild is required'
        ]);
            
        $input = $request->all();
        // validate and upload image, if error flash message.
        if ($request->hasFile('project_image')){
            $image_handler = new ImageHandler();
            $errors=$image_handler->validateImage($input['project_image']);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash('message_danger', 
                'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>'.$errors.'<b>');
            }
        }

        $project = Project::create([
            'project_title'=>$input['project_title'],
            'project_url'=>$input['project_url'],
            'project_body'=>$input['project_body']
        ]);
        
        // upload bulk image
        if ($request->hasFile('project_image')) {
            $image_handler->uploadFile($input['project_image'], $project->id, $this->image_bucket);
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
