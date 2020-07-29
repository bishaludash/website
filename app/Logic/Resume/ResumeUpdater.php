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
            return true;
        } catch (Exception $e) {
            Log::error('Failed building resume.', [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            return false;
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
            $resumeid = $this->getResumeID($uuid);
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
            // try to flattern the data and perform bulk insert
            $data = $data['job'];
            $batch_data = $this->transformJobsData($data, $resumeid);
            $count = 0;

            $insert_query = "insert into resume_jobs(job_title,job_employer, resume_id,job_city,
                            job_details,job_start_date, job_end_date,is_deleted)
                            values (?,?,?,?,?,?,?,?)";

            foreach ($batch_data as $item) {
                if ($item['job_id'] == "" || is_null($item['job_id'])) {
                    DB::insert($insert_query, [
                        $item['job_title'], $item['job_employer'], $item['resume_id'], $item['job_city'],
                        $item['job_details'],  $item['job_start_date'], $item['job_end_date'], 'f'
                    ]);
                    continue;
                }

                DB::table('resume_jobs')
                    ->where('resume_id', $resumeid)
                    ->where('id', $item['job_id'])
                    ->update([
                        "job_title" => $item['job_title'],
                        "is_deleted" => 'f',
                        "job_employer" => $item['job_employer'],
                        "job_city" => $item['job_city'],
                        "job_start_date" => $item['job_start_date'],
                        "job_end_date" => $item['job_end_date'],
                        "job_details" => $item['job_details']
                    ]);
                $count += 1;
            }

            // Log::debug('Resume jobs updated sucesfully. Item : ', ['count' => $count]);
        } catch (Exception $e) {
            Log::warning("Failed to update resume jobs info.");
            throw $e;
        }
    }

    public function updateUserEducation($data, $resumeid)
    {
        try {
            Log::debug('Begin updating resume education.');
            // try to flattern the data
            $data = $data['school'];
            $batch_data = $this->transformEducationData($data, $resumeid);
            $count = 0;

            $insert_query = "insert into resume_education(school_name,school_location, resume_id,
                            degree,edu_end_year,edu_start_year, field_of_study,is_deleted,achievements)
                            values (?,?,?,?,?,?,?,?,?)";
            foreach ($batch_data as $key => $item) {
                if ($item['school_id'] == "" || is_null($item['school_id'])) {
                    DB::insert($insert_query, [
                        $item['school_name'], $item['school_location'], $item['resume_id'], $item['degree'],
                        $item['edu_end_year'], $item['edu_start_year'], $item['field_of_study'], 'f', $item['achievements']
                    ]);
                    continue;
                }

                DB::table('resume_education')
                    ->where('resume_id', $resumeid)
                    ->where('id', $item['school_id'])
                    ->update([
                        "school_name" => $item['school_name'],
                        "is_deleted" => 'f',
                        "school_location" => $item['school_location'],
                        "degree" => $item['degree'],
                        "field_of_study" => $item['field_of_study'],
                        "edu_start_year" => $item['edu_start_year'],
                        "edu_end_year" => $item['edu_end_year'],
                        "achievements" => $item['achievements'],
                    ]);
                $count += 1;
            }

            Log::debug('Resume education populated sucesfully.');
        } catch (Exception $e) {
            Log::warning("Failed to update resume education.");
            throw $e;
        }
    }

    public function getResumeID($uuid)
    {
        return $this->selectFirstQuery('select id from resume_collects where uuid = :uuid', ['uuid' => $uuid])['id'];
    }
}
