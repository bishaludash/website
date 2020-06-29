<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ResumeController extends Controller 
{
	public function index(){
		return view('resume.index');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function build (){
		return  view('resume.build');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function saveBuild(Request $request)	{
		return $request->all();
	}

	public function generate(){
		$pdf = \PDF::loadView('resume.details');
		return $pdf->download('resume.pdf');
	}	
	
}
