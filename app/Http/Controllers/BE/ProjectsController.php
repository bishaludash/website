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
        $this->validateProject($request);

        $input = $request->all();
        // validate bulk image, if error flash message.
        if ($request->hasFile('project_image')) {
            $image_handler = new FileHandler();
            $errors = $image_handler->validateImage($input['project_image']);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash(
                    'message_danger',
                    'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>' . $errors . '<b>'
                );
                return back()->withInput();
            }
        }

        $project = Project::create([
            'project_title' => $input['project_title'],
            'project_url' => $input['project_url'],
            'project_body' => $input['project_body']
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
        // TODO show it in Fe
        $project_query = "select p.id,p.project_title, p.project_body, p.project_url, p.created_at,
        json_agg(json_build_object(
            'id',im.id, 
            'file_name',im.file_name,
            'image_path',im.image_path,
            'source',im.source, 
            'extension',im.extension)) as files
        from projects p 
        left join image_managers im on p.id=im.foreign_id 
        where p.id=:id and im.source =:source
        group by p.id";

        $project = $this->SelectQuery($project_query, ['id' => $id, 'source' => $this->image_bucket]);
        if (!is_null($project) && !empty($project)) {
            $project = $project[0];
            $project['files'] = json_decode($project['files'], true);
        } else {
            $project = Project::find($id);
            $project['files'] = null;
        }

        return view('backend.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Project $project)
    {
        $files = $this->selectQuery('select * from image_managers where foreign_id=:id', ['id' => $project['id']]);
        return view('backend.projects.edit', compact('project', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Project $project)
    {
        $this->validateProject($request);

        $input = $request->all();
        // validate bulk image, if error flash message.
        if ($request->hasFile('project_image')) {
            $image_handler = new FileHandler();
            $errors = $image_handler->validateImage($input['project_image']);

            if (!empty($errors) || !is_null($errors)) {
                session()->flash(
                    'message_danger',
                    'Please upload a valid image (jpg, jpeg, png, gif). <br>Invalid file : <b>' . $errors . '<b>'
                );
                return back()->withInput();
            }
        }
        // dd($input);
        $project->update([
            'project_title' => $input['project_title'],
            'project_url' => $input['project_url'],
            'project_body' => $input['project_body']
        ]);

        if ($request->hasFile('project_image')) {
            $image_handler->uploadFile($input['project_image'], $project->id, $this->image_bucket);
        }
        session()->flash('message_success', 'Project updated.');
        return back();
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
        $result = DB::select('select id,image_path from image_managers where foreign_id = ? and source =?', [$project->id, 'projects']);
        $files = json_decode(json_encode($result), true);
        // return $files;

        // delete from storage
        $filee_handler = new FileHandler();
        $filee_handler->deleteFiles($files, $this->image_bucket, $this->disk);

        // delete from imagemanager


        $project->delete();
        session()->flash('message_success', 'Project deleted');

        return back();
    }

    public function validateProject($input)
    {
        $input->validate([
            'project_title' => 'required',
            'project_body' => 'required',
        ], [
            'project_body.required' => 'Project details feild is required'
        ]);
    }
}
