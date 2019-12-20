<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\ImageManager;

trait ImageHandler{
    protected $img_extension = ['jpg', 'jpeg', 'png','gif'];

    /* 
    Image upload handler
    @param1 : file
    @param3 : filesystem disk
    */
    public function uploadImage($images, $path='uploads'){
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
            session()->flash('message_danger', 
            'Please upload a valid image (jpg, jpeg, png, gif). Invalid file : '.$error_files);
            return false;
        }

        foreach ($images as $key => $image) {
            // upload to path
            $img_name = str_random(10) . '-' . time() . '-' . $image->getClientOriginalName();
            $input['image_path'] = $image->storeAs('uploads/'.$path, $img_name, 'uploads');

            // Upload to image manager
            ImageManager::create([
                'image_path' => $input['image_path']
            ]);

            return $input['image_path'];
        }
        
        
    }
}