<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\Utils\FileHandler;
use App\Project;
use App\Traits\DBUtils;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    use DBUtils;
    public $image_bucket = 'projects';
    public $disk = 'uploads';
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
        // validate bulk image, if error flash message.
        if ($request->hasFile('project_image')){
            $image_handler = new FileHandler();
            $errors=$image_handler->validateImage($input['project_image']);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash('message_danger', 
                'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>'.$errors.'<b>');
                return back()->withInput();
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
        $project_query = 'select p.project_title, p.project_body, p.project_url, p.created_at,
        im.image_path, im.source, im.file_name, im."extension" from projects p 
        inner join image_managers im on p.id=im.foreign_id where p.id= :id and im.source= :source';
        
        $project = $this->selectQuery($project_query, ['id'=>$id, 'source'=>$this->image_bucket]);
        $project = $project[0];
        return view('backend.projects.show', compact('project'));
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
     * return delete project view
     *
     * @param Object pass project into view
     **/
    public function delete(Project $project)
    {
        return view('backend.projects.delete', compact('project'));
    }

    /**
     * Remove the project from database.
     *
     * @param  int  $id
     */
    public function destroy(Project $project)
    {
        // get files of project
        $result = DB::select('select image_path from image_managers where foreign_id = ? and source =?', [$project->id, 'projects']);
        $files = json_decode(json_encode($result), true);
        // return $files;

        $image_handler = new FileHandler();
        $image_handler->deleteFiles($files, $this->image_bucket, $this->disk);
               
        $project->delete();
        session()->flash('message_success', 'Project deleted');

        return back();
    }
}
