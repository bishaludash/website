<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AboutUser;

class HomeController extends Controller
{
    public function home(){
        $aboutUser = AboutUser::first(['about']);
        return view('welcome', compact('aboutUser'));
    }

    public function projects(){
        return "Comming soon";
    }
}
