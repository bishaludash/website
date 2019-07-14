<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AboutUserController extends Controller
{
    public function index(){
        return true;
    }

    public function aboutUser(User $user){        
        return view('backend.about-user', compact('user'));
    }

    public function storeAboutUser(Request $request, User $user){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
        ]);
        
        $input =  $request->all();

        $user->update([
            'fname'=>$input['fname'],
            'lname'=>$input['lname'],
            'email'=>$input['email'],
        ]);

        $user->aboutUser()->update([
            'about'=>$input['about'],
            'projects'=>$input['projects'],
            'git_url'=>$input['git_url'],
            'contact'=>$input['contact']
        ]);

        session()->flash('message_success','User updated.');
        return back();
    }
}
