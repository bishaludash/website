<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait DBUtils 
{
    /** 
     * Select query returning list
     * @var String $query 
     * @var Array params in associative array
     * */
    public function selectQuery($query, $param=null){
        // if select query does not have param
        if ($param == null) {
            $res = DB::select($query);
        }else{
            $res = DB::select($query, $param);
        }
        $result = json_decode(json_encode($res), true);
        if(count($result) >0 && !empty($result)){
            return $result;
        }
        return null;
    }

    public function selectFirstQuery($query, $param=null){
        if ($param == null) {
            $res = DB::select($query);
        }else{
            $res = DB::select($query, $param);
        }
        $result = json_decode(json_encode($res), true);
        if(count($result) >0 && !empty($result)){
            return $result[0];
        }
        // return abort(404);
        return null;
    }
}

