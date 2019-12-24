<?php

namespace App\Logic\Utils;

use App\ImageManager;
use Illuminate\Support\Facades\Storage;

class FileHandler{
    protected $disk = 'uploads';
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
     * @param Array files contains images array
     * @param Int foreignkey integer 
     * @param String bucket : path/folder for uploading
     * @param String disk
     **/
    public function uploadFile($files, $foreign_id, $bucket='', $diskname=null){
        // get disk
        $disk = is_null($diskname) ? $this->disk : $diskname;

        foreach ($files as $key => $file) {
            $file_name = $file->getClientOriginalName();
            $file_path = Storage::disk($disk)->put($bucket, $file);
            $file_type = $file->getClientOriginalExtension();

            // Upload to image manager
            ImageManager::create([
                'image_path' => $file_path,
                'foreign_id'=> $foreign_id,
                'source' =>$bucket,
                'file_name'=>$file_name,
                'extension'=>$file_type
            ]);
        }
    }

    /**
     * remove files from storage
     *
     * Undocumented function long description
     * @param Array files contains images array
     * @param String bucket : path/folder for uploading
     * @param String disk
     **/
    public function deleteFiles($files, $bucket='', $diskname = null)
    {
        // get disk
        $disk = is_null($diskname) ? $this->disk : $diskname;

        $file_del_list = [];
        foreach ($files as $file) {
            if ( Storage::disk($disk)->exists($file['image_path']) ) {
                array_push($file_del_list, $file['image_path']);
            } 
        }
        
        if (!empty($file_del_list) && count($file_del_list) > 0) {
            Storage::disk($disk)->delete($file_del_list);
        } 
    }

}