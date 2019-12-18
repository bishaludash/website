<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\ImageManager;

trait ImageHandler{
    protected $img_extension = ['jpg', 'jpeg', 'png','gif'];


    /* 
    Image upload handler
    @param1 : file
    @param2 : column name / key name
    @param3 : filesystem disk
    */
    public function uploadImage($input,$input_name = 'image_path', $path='uploads'){
        $image = $input[$input_name];
        $ext = $image->getClientOriginalExtension();

        // validate extension
        if (!in_array(strtolower($ext), $this->img_extension)) {
            session()->flash('message_danger', 'Please upload a valid image. i.e: jpg, jpeg, png, gif');
            return false;
        }
        // upload to path
        $img_name = str_random(10) . '-' . time() . '-' . $image->getClientOriginalName();
        $input[$input_name] = $image->storeAs('uploads/'.$path, $img_name, 'uploads');

        // Upload to image manager
        ImageManager::create([
            'image_path' => $input[$input_name]
        ]);

        return $input[$input_name];
    }
}