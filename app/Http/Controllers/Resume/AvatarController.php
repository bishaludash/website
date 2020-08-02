<?php

namespace App\Http\Controllers\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    protected $img_extension = ['jpg', 'jpeg', 'png'];

    public $image_bucket = 'resume';
    public $disk = 'uploads';

    /**
     * Function to Upload the user image and gives the path
     * for uploaded image. Return view with uploaded image.
     * 
     * @param file image
     * @return view 
     */
    public function uploadAvatar(Request $request)
    {
        try {
            // Handle when pressed escape while uploading file
            if (!$request->hasFile('user_avatar')) {
                return "no file";
            }

            // read file metric data
            $file =  $request->file('user_avatar');
            $name =  $file->getClientOriginalName();
            $extension =  $file->getClientOriginalExtension();
            $size = $file->getSize();

            // validate image
            $error = $this->validateFile($extension, $size);
            if (!is_null($error)) {
                return $error;
            }

            // upload image
            $file_path = $this->uploadFile($file, $name, $size, $extension);

            return [
                'status' => 'pass',
                'message' => "Avatar uploaded.",
                'image_path' => $file_path
            ];
        } catch (Exception $e) {
            Log::error('Failed uploading avatar.', [
                'File' => 'AvatarController.php',
                'Line' => $e->getLine(),
                'Message' => $e->getMessage()
            ]);
            return [
                'status' => 'fail',
                'message' => 'Failed uploading avatar.'
            ];
        }
    }

    public function validateFile($extension, $size)
    {
        // validate image extension
        if (!in_array(strtolower($extension), $this->img_extension)) {
            return [
                'status' => 'fail',
                'message' => 'Please upload valid image file. Supported ie jpeg, jpg, png'
            ];
        }

        // check size is smaller than 2MB
        // convert : bytes -> kb-> mb
        $size = round(($size / 1000 / 1024), 2);
        if ($size > 3) {
            return [
                'status' => 'fail',
                'message' => 'Please upload image lower than 2 MB.'
            ];
        }
        return null;
    }


    /**
     * Function to save file to database and insert record to DB
     *
     *
     * @param String $file, $name, $size, $extension
     * @return String file path 
     * @throws Exception $e
     **/
    public function uploadFile($file, $name, $size, $extension)
    {
        try {
            // upload to disk and insert to database;
            $image_path = Storage::disk($this->disk)->put($this->image_bucket, $file);
            $status = DB::table('image_managers')->insert([
                'image_path' => 'storage/' . $image_path,
                'created_at' => Carbon::now(),
                'source' => 'Resume',
                'file_name' => $name,
                'extension' => $extension,
                'file_size' => $size
            ]);

            if ($status) {
                return "/storage/" . $image_path;
            }

            throw new Exception("Avatar could not be updated.");
        } catch (Exception $e) {
            throw $e;
        }
    }
}
