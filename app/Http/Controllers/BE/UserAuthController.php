<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $input =  $request->only('be_email', 'be_password');
        $creadentials['email'] = $input['be_email'];
        $creadentials['password'] = $input['be_password'];

        try{
           // Check if the credentials are valid, the login
            if(Auth::attempt($creadentials)){
                return redirect()->route('blog.home');
            }else {
                session()->flash('Message', 'Could not Login');
                return redirect()->route('be.login');
            }
        }
        catch(\Exception $e){
            return $e;
        } 
    }

    public function logout(){
        if (Auth::check()) {
            auth()->logout();
            return redirect()->route('blog.home');
        }
        return back();
    }

}
