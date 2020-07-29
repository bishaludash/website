<?php

namespace App\Http\Controllers\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\Resume\ResumeBuilder;
use App\Logic\Resume\ResumeDataGenerator;
use App\Logic\Resume\ResumeUpdater;


class ResumeEditController extends Controller
{

    /**
     * Returns edit view for editing resume.
     *
     * @param String $uuid Resume identifier
    
     **/
    public function showEditPage($uuid)
    {
        $themeObj = new ResumeDataGenerator();
        $resume = $themeObj->getUserResumeData($uuid);
        return view('resume.editResume', compact(['resume', 'uuid']));
    }

    /**
     * soft delete job or education
     *
     * @param Int $id primary key of entity to be deleted.
     * @param String $typeid Factor that points out which item to delete.
     * @return Boolean 0 or 1
     **/
    public function softDeleteItem($uuid, $typeid)
    {
        $updaterObj = new ResumeUpdater();
        $res = $updaterObj->deleteItem($uuid, $typeid);
        // handle if null
        return $res;
    }


    /**
     * POST Request : Update the resume data
     *
     * @param Int $resumeid Id of resume to be updated.
     **/
    public function updateResume(Request $request, $uuid)
    {
        $input =  $request->json()->all();
        $updaterObj = new ResumeUpdater();
        // get resumeid
        $resumeid = $updaterObj->getResumeID($uuid);

        // validate input data and if any error found raise exception
        // ResumeUpdater extends from resume builder
        $validation_error = $updaterObj->validateInput($input);
        if (!is_null($validation_error) || !empty($validation_error)) {
            return $validation_error;
        }
        $status = $updaterObj->updateResume($input, $resumeid);

        if ($status) {
            session()->flash('message', 'Resume updated successfully, select a theme to preview.');
            return [
                'status' => 'success',
                'message' => 'Resume updated successfully.',
                'url' => route('resume.theme', ['uuid' => $uuid])
            ];
        }
    }
}
