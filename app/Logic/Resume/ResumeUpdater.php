<?php

namespace App\Logic\Resume;

use App\Logic\Resume\ResumeBuilder;
use App\Traits\DBUtils;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeUpdater extends ResumeBuilder
{
    use DBUtils;

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
            Log::debug("Begin updating resume.");
            DB::transaction(function () use ($data, $resume_id) {

                // Insert into resume_users
                $this->updateUserInfo($data, $resume_id);

                // Insert into resume_jobs
                $this->updateUserJobs($data, $resume_id);

                // // // Insert into resume_education
                $this->updateUserEducation($data, $resume_id);
            });
            Log::debug("Resume updated successfully.");
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
    public function deleteItem($uuid, $typeid)
    {
        try {
            Log::debug("Inside soft delete school/job function.");

            // fetch resumeid
            $resumeid = $this->selectFirstQuery('select id from resume_collects where uuid = :uuid', ['uuid' => $uuid])['id'];
            if (is_null($resumeid)) {
                Log::debug("Incorrect resume uuid, stopping further action.");
                throw new Exception("Incorrect resume uuid, stopping further action.");
            }
            $query = "update %s set is_deleted='t' where resume_id=:resume_id and id = :id";
            $factor =  explode("-", $typeid);
            $table = $factor[0] == 'edu' ? 'resume_education' : 'resume_jobs';
            $deleteQuery = sprintf($query, $table);

            Log::debug("Executing query : " . $deleteQuery, ['resume_id' => $resumeid, 'id' => $factor[1]]);
            $status = DB::update($deleteQuery, ['resume_id' => $resumeid, 'id' => $factor[1]]);

            return $status;
        } catch (Exception $e) {
            Log::warning("Could not delete item.", [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function updateUserInfo($data, $resumeid)
    {
        try {
            Log::debug("Updating resume user info.");
            $status = DB::table('resume_users')
                ->where('resume_id', $resumeid)
                ->where('id', $data['user_id'])
                ->update([
                    "r_user_fname" => $data['first_name'],
                    "r_user_lname" => $data['last_name'],
                    "city" => $data['city'],
                    "state_province" => $data['state_province'],
                    "zip" => $data['zip'],
                    "phone" => $data['phone'],
                    "email" => $data['email'],
                    "skills" => $data['skills'],
                    "summary" => $data['user_summary'],
                    "is_deleted" => 'f'
                ]);

            if ($status) {
                Log::info("Resume user info updated.");
            }
        } catch (Exception $e) {
            Log::warning("Could not update user info.");
            throw $e;
        }
    }

    public function updateUserJobs($data, $resumeid)
    {
        try {
            Log::debug('Begin updating resume jobs.');
            // try to flattern the data
            $data = $data['job'];
            $batch_jobs = $this->transformJobsData($data, $resumeid);
            // bulk insert
            $status = false;
            if ($status) {
                Log::debug('Resume jobs updated sucesfully.');
            }
        } catch (Exception $e) {
            Log::warning("Failed to update resume jobs info.");
            throw $e;
        }
    }

    public function updateUserEducation($data, $resumeid)
    {
        Log::debug('Begin updating resume education.');
        // try to flattern the data
        $data = $data['school'];
        $batch_data = $this->transformEducationData($data, $resumeid);
        dd($batch_data);


        // bulk insert
        $status = false;
        if ($status) {
            Log::debug('Resume education populated sucesfully.');
        }
    }
}
