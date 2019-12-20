<?php

namespace App\Logic\Utils;

use App\ImageManager;

class ImageHandler{
    protected $img_extension = ['jpg', 'jpeg', 'png','gif'];
    protected $file_extension = [];

    /**
     * File validator
     *
     * @param Array images/files to be validated
     * @return String Error if invalid file is uploaded     * 
     * 
     **/
    public function validateImage($images){
        // dd($images);
        $errors = [];
        foreach ($images as $image) {
            $ext = $image->getClientOriginalExtension();
            $name = $image->getClientOriginalName();

            // validate extension
            if (!in_array(strtolower($ext), $this->img_extension)) {
                array_push($errors, $name);
                continue;
            }
        }

        // Check errors
        if (!empty($errors) || count($errors) > 0) {
            $error_files = implode(', ',$errors);
            return $error_files;
        }       
    }

    
    /**
     * Handles bulk file Uploads :Images
     *
     * @param Array images contains images array
     * @param Int foreignkey integer 
     * @param Disk filesystem disk for uploading
     **/
    public function uploadFile($files, $id, $path='uploads'){
        // dd($id);
        foreach ($files as $key => $file) {
            // upload to path
            $file_name = str_random(10) . '-' . time() . '-' . $file->getClientOriginalName();
            $file_path = $file->storeAs('uploads/'.$path, $file_name, 'uploads');

            // Upload to image manager
            ImageManager::create([
                'image_path' => $file_path,
                'foreign_id'=> $id,
                'source' =>$path
            ]);
        }
    }


    
}