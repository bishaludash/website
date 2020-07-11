<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logic\Resume\ResumeBuilder;

class ResumeController extends Controller
{
	/** 
	 * Return main index page view.
	 * @return View
	 */
	public function index()
	{
		return view('resume.index');
	}

	/** 
	 * Returns to resume builder view.
	 * @return View
	 */
	public function build()
	{
		return view('resume.build');
	}

	/**
	 * Function to process the user information, 
	 * validate and populate database
	 *
	 * @return boolean [True, False]
	 * @author Bishal udash
	 **/
	public function saveBuild(Request $request)
	{
		$input =  $request->json()->all();
		$obj = new ResumeBuilder();

		// validate input data and if any error found raise exception
		$validation_error = $obj->validateInput($input);
		if (!is_null($validation_error) || !empty($validation_error)) {
			return $validation_error;
		}

		// Insert Resume details to DB
		return $obj->buildResume($input);
	}

	/**
	 * Function to Upload the user image and gives the path
	 * for uploaded image. Return view with uploaded image.
	 * 
	 * @param file image
	 * @return view 
	 */
	public function uploadUserAvatar()
	{
		// save user image into disk
		// return the path of saved file
	}

	public function generate()
	{
		$pdf = \PDF::loadView('resume.details');
		return $pdf->download('resume.pdf');
	}
}
