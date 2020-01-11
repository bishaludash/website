<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public $errors = [];
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        // validation
        $request->validate([
            'be_email' =>'required',
            'be_password'=>'required',
        ]);
        
        $input =  $request->only('be_email', 'be_password');
        $creadentials['email'] = $input['be_email'];
        $creadentials['password'] = $input['be_password'];
        
        // regex to prevent login attempt
        $regex = "/[A-Za-z0-9\._-]+@[A-Za-z0-9_]+\.[a-zA-Z]{3,4}/i";
        $special_chars = '/["*$%&!^]/';
        if (!preg_match($regex, $creadentials['email'], $matched ) || preg_match($special_chars, $creadentials['email'], $match)) {
            array_push($this->errors, "Invalid Email provided." );
        }

        // Check if the credentials are valid, then login
        if(Auth::attempt($creadentials)){
            return redirect()->route('home');
        }else {
            array_push($this->errors, "Could not login.");
        }

        session()->flash('message',  implode('<br>', $this->errors));
        return redirect()->route('be.login');
    }

    public function logout(){
        if (Auth::check()) {
            auth()->logout();
            return redirect()->route('home');
        }
        return back();
    }


    function get_ip_address(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
    
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

}
