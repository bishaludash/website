<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Logic\Resume\ResumeBuilder;
use App\Traits\ValidateUtils;

class ResumeController extends Controller
{
	use ValidateUtils;
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
		// validate input data and if any error found raise exception
		$input =  $request->all();
		$validation_error = $this->validate_input($input, $this->validate_rules);
		if (!is_null($validation_error) || !empty($validation_error)) {
			return $validation_error;
		}

		// return $validation;

		$obj = new ResumeBuilder();



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

	private $validate_rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'phone' => 'required',
		'email' => 'required',
		'job.title.*' => 'required|distinct',
		'job.employer.*' => 'required',
		'education.school_name.*' => 'required',
		'education.school_location.*' => 'required',
		'skills' => 'required',
		'summary' => 'required',
	];

	private $validate_message = [];
}
