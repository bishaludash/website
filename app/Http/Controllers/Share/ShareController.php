<?php

namespace App\Http\Controllers\Share;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShareController extends Controller
{
    /**
     * undocumented function summary
     **/
    public function index()
    {
        return view('share.index');
    }

    /**
     * Read Todays share dump and return jason
     **/
    public function getTodayshareApi()
    {
        try {
            $path = env('APP_URL') . Storage::url('nepse');
            $file = 'todayshare.json';
            $filepath = sprintf('%s/%s', $path, $file);
            $string = file_get_contents($filepath);
            $json_a = json_decode($string, true);

            return $json_a;
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
