<?php

namespace App\Logic\Resume;

use App\Logic\Resume\ResumeBuilder;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeUpdater extends ResumeBuilder
{
    private $filename = null;

    public function __construct()
    {
        $this->filename = basename(__FILE__);
    }


    /**
     * update resume function
     *
     * @param Object $data data to be updated
     * @return type
     * @throws conditon
     **/
    public function updateResume($data, $resume_id)
    {
        try {

            DB::transaction(function () use ($data, $resume_id) {
                // Insert into resume_collects

                // Insert into resume_users
                $this->updateUserInfo($data, $resume_id);

                // Insert into resume_jobs
                $this->updateUserJobs($data, $resume_id);

                // // Insert into resume_education
                $this->updateUserEducation($data, $resume_id);
            });
        } catch (Exception $e) {
            Log::error('Failed building resume.', [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
        }
    }

    /**
     * soft delete function
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function deleteItem($resumeid, $typeid)
    {
        try {
            Log::debug("Inside soft delete school/job function.");

            $query = "update %s set is_deleted='t' where resume_id=:resume_id and id = :id";
            $factor =  explode("-", $typeid);
            $table = $factor[0] == 'edu' ? 'resume_education' : 'resume_jobs';
            $deleteQuery = sprintf($query, $table);

            Log::debug("Executing query : " . $deleteQuery, ['resume_id' => $resumeid, 'id' => $factor[1]]);
            $status = DB::update($deleteQuery, ['resume_id' => $resumeid, 'id' => $factor[1]]);

            return $status;
        } catch (Exception $e) {
            Log::warning("Could not delete item.", [
                'File' => 'ResumeEditController',
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
        }
    }

    public function updateUserInfo()
    {
    }

    public function updateUserJobs()
    {
    }

    public function updateUserEducation()
    {
    }
}
