<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Jobs\SendResumeGeneratedMailJob;
use Illuminate\Http\Request;
use App\Logic\Resume\ResumeBuilder;
use App\Logic\Resume\ResumeDataGenerator;
use App\Mail\SendResumeGeneratedMail;
use App\Traits\DBUtils;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ResumeController extends Controller
{
	use DBUtils;

	private $themeTemplateString = 'resume.template.';
	private $themes = [
		"template1" => "template1",
		"template2" => "template2",
	];

	public function __construct()
	{
		DB::enableQueryLog();
	}

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
	 * This function is called via ajax.
	 *
	 * @param Object form data in json. 
	 * @return String UUID 
	 * @author Bishal udash
	 **/
	public function saveBuild(Request $request)
	{
		Log::debug("Begin saveBuild entry function");
		$input =  $request->json()->all();
		$obj = new ResumeBuilder();

		// validate input data and if any error found raise exception
		$validation_error = $obj->validateInput($input);
		if (!is_null($validation_error) || !empty($validation_error)) {
			return $validation_error;
		}
		// Insert Resume details to DB
		$resume_uuid =  $obj->buildResume($input);

		// send email in queue
		$this->sendResumeGeneratedMail($resume_uuid, $input);

		if (!is_null($resume_uuid)) {
			session()->flash('message', 'Resume build successfully.');
			return [
				'status' => 'success',
				'message' => 'Resume build successfully.',
				'url' => route('resume.theme', ['uuid' => $resume_uuid])
			];
		}
	}

	/**
	 * Redirects to theme templates page  
	 *
	 * @param String $uuid uuid is sent via sting query parameter
	 **/
	public function showThemes(Request $request)
	{
		$uuid = $request->input('uuid') ?? null;

		return view('resume.themes.index')
			->with(['themes' => $this->themes, 'uuid' => $uuid]);
	}

	/**
	 * Pick theme template and get the
	 * resume data to show in UI
	 *
	 * @param string $uuid UUID generated for a resume
	 * @return string $email email address
	 **/
	public function pickTheme(Request $request, $theme)
	{
		// get template name and check if valid template or not
		if (!in_array($theme, $this->themes)) {
			return redirect()->route('resume.theme');
		}
		$template = $this->themeTemplateString . $theme;

		// get/generate user's resume data
		$uuid = $request->input('uuid') ?? null;
		$themeObj = new ResumeDataGenerator();
		$resume = $themeObj->getUserResumeData($uuid);

		// if invalid resumeid was given
		if (is_null($resume)) {
			return redirect()->route('resume.build');
		}


		// put the resume data in session so that we can
		// use this data for downloading resume also
		Session::put('resume', $resume);
		// return view
		return view('resume.themes.picktheme', compact(['template', 'resume']));
	}

	/* Function to generate pdf resume */
	public function generate(Request $request)
	{
		$theme = $request->input('theme');
		$resume = Session::get('resume');

		$pdf = \PDF::loadView($theme, compact('resume'));
		return $pdf->download('resume.pdf');
	}

	public function searchGeneratedResume()
	{
		return view('resume.layouts.searchResume');
	}

	public function getGeneratedResume(Request $request)
	{
		// check if uuid is present
		$uuid =  $request->input('resume_uuid') ?? null;
		if (is_null($uuid)) {
			session()->flash('message', 'Resume unique ID cannot be empty.');
			return redirect()->back();
		}

		// check if resume exists for that uuid
		$get_resumeid_query = "select id from resume_collects where uuid = :uuid";
		$resume_id = $this->selectFirstQuery($get_resumeid_query, ['uuid' => $uuid])['id'];

		if (is_null($resume_id)) {
			session()->flash('message', 'Resume could not be found.');
			return redirect()->back();
		}

		session()->flash('message', 'Resume found. Please select a theme to view it.');
		return redirect()->route('resume.theme', ['uuid' => $uuid]);
	}

	/**
	 * Job to send email after resume is build
	 *
	 * @param String uuid
	 **/
	public function sendResumeGeneratedMail($uuid, $data)
	{
		Log::info("Resume build successfully, sending email to user.");
		$job = (new SendResumeGeneratedMailJob($uuid, $data))
			->delay(Carbon::now()->addSeconds(5));

		dispatch($job);
		Log::info("Resume build successfully, sending email to user.");
	}
}
