<?php

namespace App\Http\Controllers\FE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function aboutUser(){
        return "about";
    }

    public function projects(){
        return "project";
    }
}
