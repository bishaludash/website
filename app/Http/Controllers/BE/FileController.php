<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImageManager;
use App\Logic\Utils\FileHandler;
use App\Traits\DBUtils;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{   
    use DBUtils;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $files_query = "select * from image_managers order by created_at desc";
        $files = $this->selectQuery($files_query);
        return view('backend.filemanager.index', compact('files'));
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "it works";
    }

    /**
     *
     * Undocumented function long description
     *
     **/
    public function delete($ids)
    {
        // $ids = [92, 93, 94];
        if (is_array($ids)) {
            $files = DB::table('image_managers')
            ->whereIn('id', $ids)->get();
            $ids = implode(',', $ids);
        }else{
            $get_file =DB::table('image_managers')->find($ids);
            $files = [];
            array_push($files, $get_file);
        }
        // dd($ids);
        return view('backend.filemanager.delete', compact('files', 'ids'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $input = $request->all();
        $ids = explode(',',  $input['file_ids']);
        $files = DB::table('image_managers')
                ->whereIn('id',$ids)
                ->get();

        $files = json_decode($files, true);
        $bucket = $files[0]['source'];
        // dd($files);

        $image_handler = new FileHandler();
        $image_handler->deleteFiles($files, $bucket);

        DB::table('image_managers')
                    ->whereIn('id',$ids)
                    ->delete();
        
        session()->flash('message_success', 'File deleted.');
        return back();
    }   
}
