<?php

namespace App\Logic\Resume;

use Exception;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;
use App\Traits\DBUtils;

class  ResumeDataGenerator
{
    use DBUtils;
    private $filename = null;

    public function __construct()
    {
        $this->filename = basename(__FILE__);
    }

    /**
     * Entry function
     * Fetches users resume details based on uuid
     * If uuid is nul, returns dummy resume details
     *
     * @param String $uuid key for finding userdetails
     * @return Array
     **/
    public function getUserResumeData($uuid)
    {
        try {
            Log::debug('Inside get user resume details function.');

            // check if uuid is null, return dummy value
            if (is_null($uuid)) {
                return $this->getDefaultResume();
            }
            $get_resumeid_query = "select id from resume_collects where uuid = :uuid";
            $resume_id = $this->selectFirstQuery($get_resumeid_query, ['uuid' => $uuid])['id'];

            if (is_null($resume_id)) {
                return null;
            }


            // fetch resume user, jobs, edu
            $resume_user_query = "select id,resume_id, r_user_fname as first_name,r_user_lname as last_name, r_user_avatar as avatar,
                                    city, state_province, zip, phone, email, skills, summary as user_summary
                                    from resume_users where resume_id = :resumeid";
            $resume_data = $this->selectFirstQuery($resume_user_query, ['resumeid' => $resume_id]);

            // fetch jobs
            $jobs_query = "select id, job_title, job_employer, job_city, job_start_date,
                        job_end_date, job_details from resume_jobs where is_deleted='f'
                        and resume_id = :resumeid order by id asc";
            $resume_data['jobs'] = $this->selectQuery($jobs_query, ['resumeid' => $resume_id]);

            // fetch school
            $school_query = "select id,school_name, school_location, degree, field_of_study,
                            achievements, edu_start_year, edu_end_year from resume_education
                            where resume_id = :resumeid and is_deleted='f' order by id asc";
            $resume_data['school'] = $this->selectQuery($school_query, ['resumeid' => $resume_id]);


            return $resume_data;
        } catch (Exception $e) {
            Log::error('Could not fetch resume details.', [
                'File' => $this->filename,
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Function to return default value for resume theme
     *
     * @return Array array with dummy resume data
     **/
    public function getDefaultResume()
    {
        $faker = Faker::create();
        return $input = [
            "first_name" => $faker->firstName(),
            "last_name" => $faker->lastName(),
            "city" => $faker->city(),
            "state_province" =>  $faker->state(),
            "zip" =>  $faker->postcode(),
            "phone" =>  $faker->phoneNumber(),
            "email" =>  $faker->safeEmail(),
            "skills" =>  $faker->sentence(),
            "user_summary" =>  $faker->paragraph($nbSentences = 15, $variableNbSentences = true),
            "jobs" => [
                [
                    'job_title' => $faker->jobTitle(),
                    'job_employer' => $faker->company(),
                    'job_city' => $faker->city(),
                    'job_start_date' => date('Y-m-d'),
                    'job_end_date' => "",
                    'job_details' => $faker->text($maxNbChars = 200),
                ],
                [
                    'job_title' => $faker->jobTitle(),
                    'job_employer' => $faker->company(),
                    'job_city' => $faker->city(),
                    'job_start_date' => date('Y-m-d'),
                    'job_end_date' => date('Y-m-d'),
                    'job_details' => $faker->text($maxNbChars = 200),
                ],
            ],
            "school" =>  [
                [
                    'school_name' => $faker->company(),
                    'school_location' => $faker->streetName(),
                    'degree' => $faker->word(),
                    'field_of_study' => $faker->jobTitle(),
                    'edu_start_year' => date('Y-m'),
                    'edu_end_year' => date('Y-m'),
                    'achievements' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                ],
                [
                    'school_name' => $faker->company(),
                    'school_location' => $faker->streetName(),
                    'degree' => $faker->word(),
                    'field_of_study' => $faker->jobTitle(),
                    'edu_start_year' => date('Y-m'),
                    'edu_end_year' => date('Y-m'),
                    'achievements' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                ],

            ]
        ];
    }
}
