<?php


namespace App\Logic\Resume;

use App\Resume;
use App\Traits\DBUtils;
use App\Traits\ValidateUtils;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeBuilder
{

    use DBUtils;
    use ValidateUtils;

    private $filename = null;

    public function __construct()
    {
        $this->filename = basename(__FILE__);
    }

    /**
     * Entry function
     * Function to populate the resume data into database
     *
     * @param Array $data Input from resume builder UI.
     * @return boolean True if success,else false
     **/
    public function buildResume(array $data)
    {
        try {
            $resume_id = $this->insertToCollects($data);
            if (is_null($resume_id)) {
                throw new Exception("Error while populating collects info to DB.");
            }

            DB::transaction(function () use ($data, $resume_id) {
                // Insert into resume_collects

                // Insert into resume_users
                $this->insertUserInfo($data, $resume_id);

                // Insert into resume_jobs
                $this->insertUserJobs($data, $resume_id);

                // // Insert into resume_education
                // $this->insertUserEducation($data, $resume_id);
            });
        } catch (Exception $e) {
            Log::error('Failed building resume.', [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            return False;
        }
    }


    /**
     * Validate the input data.
     *
     * @param Array $data form data
     * @return object json when validation fails else returms null.
     **/
    public function validateInput(array $data)
    {
        $validation_error = $this->validate_input($data, $this->validate_rules, $this->validate_message);
        if (!is_null($validation_error) || !empty($validation_error)) {
            return $validation_error;
        }
    }

    /**
     * Populate the collect info into database
     * stores UUID and user email
     *
     * @param Array $data Array of form inputs
     * @return int $resume_id,  primary key used in all other table
     **/
    public function insertToCollects(array $data)
    {
        try {
            $collect_id = Resume::create([
                'uuid' => uniqid() . '_' . date('Y-M-d'),
                'email' => $data['email'],
                'message' => 'Begin processing.'
            ]);
            return $collect_id->id;
        } catch (\Throwable $e) {
            Log::error("Could not insert to collects.");
            throw $e;
        }
    }


    /**
     * Populate the user info into database
     *
     * @param array $data Description
     * @param int $resume_id Description
     * @return boolean [true, false] 
     * @throws conditon
     **/
    public function insertUserInfo(array $data, int $resume_id)
    {
        try {
            $idd = DB::table('resume_users')->insert([
                "resume_id" => $resume_id,
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
        } catch (\Throwable $th) {
            Log::debug("Error while populating users info to database.");
            throw $th;
        }
    }

    /**
     *  Populate the user jobs into database
     *
     * @param array $data Description
     * @param int $resume_id Description
     * @return boolean [true, false] 
     * @throws conditon
     **/
    public function insertUserJobs(array $data, int $resume_id)
    {
        # code...
    }

    /**
     *  Populate the user education into database
     *
     *
     * @param Type $var Description
     * @return boolean [true, false] 
     * @throws conditon
     **/
    public function insertUserEducation(array $data)
    {
        # code...
    }

    private $validate_rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'job.title.*' => 'required|distinct',
        'job.employer.*' => 'required',
        'school.name.*' => 'required',
        'school.location.*' => 'required',
        'school.degree.*' => 'required',
        'school.field_of_study.*' => 'required',
        'school.start_year.*' => 'required|date',
        'school.end_year.*' => 'required|date',
        'skills' => 'required',
        'user_summary' => 'required',
    ];

    private $validate_message = [
        'first_name.required' => 'First name can not be empty.',
        'last_name.required' => 'Last name can not be empty.',
        'phone.required' => 'Phone number can not be empty.',
        'email.required' => 'Email can not be empty.',
        'skills.required' => "Are you sure you don't have any skills ?",
        'user_summary.required' => 'First impression is the last impression.',
        'job.title.*.required' => 'Job title field can not be empty.',
        'job.title.*.distinct' => 'Job title field can not be duplicate.',
        'job.employer.*.required' => 'Job employer field can not be empty.',
        'school.name.*.required' => 'School name can not be empty.',
        'school.location.*.required' => 'School location can not be empty.',
        'school.degree.*.required' => 'Degree can not be empty.',
        'school.field_of_study.*.required' => 'Field of study can not be empty.',
        'school.start_year.*.required' => 'Start year is required',
        'school.end_year.*.required' => 'End year is required',
    ];
}
