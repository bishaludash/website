<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('welcome');
    }

    /**
    *Returns view blog ko home
    *
    * @param 
    * @return Response : view(app)
    */
    public function blogHome(){
        return view('app');
    }
}
