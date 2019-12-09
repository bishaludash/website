<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait DBUtils 
{
    /* 
    @select query
    param1: query in sting.
    param2: array
    */
    public function selectQuery($query, $param=null){
        // if select query does not have param
        if ($param == null) {
            $res = DB::select($query);
        }else{
            $res = DB::select($query, $param);
            
        }
        return json_decode(json_encode($res), true);
    }
}

