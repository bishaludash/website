<?php


namespace App\Logic\Resume;

use App\Traits\DBUtils;

class ResumeBuilder{
    
    use DBUtils;
    
    /**
    * Entry function
    * Function to populate the resume data into database
    *
    * @param Array $data Input from resume builder UI.
    * @return type
    **/
    public function buildResume(array $data)
    {
        try {
            return $data;
            // Insert into resume_collects
            $resume_id = $this->insertToCollects($data);
            
            // Insert into resume_users
            $this->insertUserInfo($data, $resume_id);
            
            // Insert into resume_jobs
            $this->insertUserJobs($data, $resume_id);

             // Insert into resume_education
             $this->insertUserEducation($data, $resume_id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
         
    }
    
    
    /**
    * Validate the input data.
    *
    * @param Array $var Description
    * @return boolean [true, false] 
    **/
    public function validateInput(array $var, $rules)
    {
        # code...
    }
    
    /**
    * Populate the collect info into database
    * stores UUID and user email
    *
    * @param Type $var Description
    * @return int $resume_id primary key used in all other table
    * @throws conditon
    **/
    public function insertToCollects(array $data)
    {
        # code...
    }
    
    
    /**
    * Populate the user info into database
    *
    * @param array $data Description
    * @param int $resume_id Description
    * @return type
    * @throws conditon
    **/
    public function insertUserInfo(array $data, int $resume_id)
    {
        # code...
    }
    
    /**
    *  Populate the user jobs into database
    *
    * @param array $data Description
    * @param int $resume_id Description
    * @return type
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
    * @return type
    * @throws conditon
    **/
    public function insertUserEducation(Type $var = null)
    {
        # code...
    }
    
    
}


