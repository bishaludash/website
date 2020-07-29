<?php


namespace App\Logic\Resume;

use App\Resume;
use App\Traits\DBUtils;
use App\Traits\ValidateUtils;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeBuilder
{

    use DBUtils, ValidateUtils;
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
     * @return boolean resume id if success,else null
     **/
    public function buildResume(array $data)
    {
        try {
            Log::debug("Begin populating resume data into database.");
            $collect_resume = $this->insertToCollects($data);
            $resume_id = $collect_resume->id;
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
                $this->insertUserEducation($data, $resume_id);
            });

            Log::debug("Resume data populated successfully.");
            $collect_resume->update(['status' => 'Success', 'message' => 'Resume build successfully.']);
            return $collect_resume['uuid'];
        } catch (Exception $e) {
            Log::debug("Updating collects status as failed.");
            $collect_resume->update(['status' => 'Fail', 'message' => 'Failed building resume.']);

            Log::error('Failed building resume.', [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            return null;
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
        Log::debug('Validating data before populating database.');
        $validation_error = $this->validate_input($data, $this->validate_rules, $this->validate_message);
        if (!is_null($validation_error) || !empty($validation_error)) {
            Log::error('Validating failed.');
            return $validation_error;
        }

        Log::debug('Validation complete.');
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
            Log::debug('Insert into collects table.');
            $collect_data = Resume::create([
                'uuid' => uniqid() . '_' . date('Y-M-d'),
                'email' => $data['email'],
                'message' => 'Begin processing.'
            ]);

            return $collect_data;
        } catch (Exception $e) {
            Log::error("Could not insert to collects.", [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Populate the user info into database
     *
     * @param array $data Description
     * @param int $resume_id Description
     **/
    public function insertUserInfo(array $data, int $resume_id)
    {
        try {
            Log::debug('Begin populating user information.');
            $status = DB::table('resume_users')->insert([
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

            if ($status) {
                Log::debug("User info populated successfully.");
            }
        } catch (Exception $e) {
            Log::error("Error while populating users info.", [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     *  Populate the user jobs into database
     *
     * @param array $data array containing jobs details
     * @param int $resume_id Collects resume id
     * @throws exception
     **/
    public function insertUserJobs(array $data, int $resume_id)
    {
        try {
            Log::debug('Begin populating resume jobs.');
            // try to flattern the data and exclude the id key as it is not present while inserting
            $data = $data['job'];
            unset($data['id']);
            $batch_jobs = $this->transformJobsData($data, $resume_id);

            // bulk insert
            $status = DB::table('resume_jobs')->insert($batch_jobs);
            if ($status) {
                Log::debug('Resume jobs populated sucesfully.');
            }
        } catch (Exception $e) {
            Log::error("Error while populating jobs info.", [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     *  Populate the user education into database
     *
     *
     * @param Type $var Description
     * @return boolean [true, false] 
     * @throws conditon
     **/
    public function insertUserEducation(array $data, int $resume_id)
    {
        try {
            Log::debug('Begin populating resume education into database.');
            // try to flattern the data and exclude the id key as it is not present while inserting
            $data = $data['school'];
            unset($data['school_id']);
            $batch_data = $this->transformEducationData($data, $resume_id);

            // bulk insert
            $status = DB::table('resume_education')->insert($batch_data);
            if ($status) {
                Log::debug('Resume education populated sucesfully.');
            }
        } catch (Exception $e) {
            Log::error("Error while populating education info to database.", [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function transformEducationData($data, $resume_id)
    {
        $edu_count = count($data['name']);
        $batch = [];
        for ($i = 0; $i < $edu_count; $i++) {
            $edu = [];
            foreach ($data as $key => $value) {

                //rename key : change date column
                $nkey = $key;
                if (in_array($key, ['start_year', 'end_year'])) {
                    $nkey = 'edu_' . $key;
                    $data[$key][$i] = Carbon::parse($data[$key][$i])->format('M Y');
                } elseif (in_array($key, ['name', 'location'])) {
                    $nkey = 'school_' . $key;
                }
                $edu[$nkey] = $data[$key][$i];
                $edu['resume_id'] = $resume_id;
                $edu['is_deleted'] = false;
            }
            array_push($batch, $edu);
        }
        return $batch;
    }

    public function transformJobsData($data, $resume_id)
    {
        $job_count = count($data['title']);
        $batch = [];
        for ($i = 0; $i < $job_count; $i++) {
            $job = [];
            foreach ($data as $key => $value) {
                // handle for I am currently working in this role
                if ($key == 'end_date') {
                    $data[$key][$i] = $data[$key][$i] == "" ? null : $data[$key][$i];
                }
                //rename key : add job_ prefix
                $nkey = $key != 'job_details' ? 'job_' . $key : $key;
                $job[$nkey] = $data[$key][$i];
                $job['resume_id'] = $resume_id;
                $job['is_deleted'] = false;
            }
            array_push($batch, $job);
        }
        return $batch;
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
