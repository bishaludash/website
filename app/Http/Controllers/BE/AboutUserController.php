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

    public function updateAboutUser(Request $request, User $user){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
        ]);
        
        $input =  $request->all();
        // return $input;
        $user->update([
            'fname'=>$input['fname'],
            'lname'=>$input['lname'],
            'email'=>$input['email'],
        ]);
        
        // if about does not exist create
        if (!$user->aboutUser) {
            $user->aboutUser()->create([
                'about'=>$input['about'] ?? ' ',
                'git_url'=>$input['git_url'] ?? ' ',
                'contact'=>$input['contact'] ?? ' ',
                'experience'=>$input['experience'] ?? ' '
            ]);
        }
        
        $user->aboutUser()->update([
            'about'=>$input['about'] ?? ' ',
            'git_url'=>$input['git_url'] ?? ' ',
            'contact'=>$input['contact'] ?? ' ',
            'experience'=>$input['experience'] ?? ' '
        ]);

        session()->flash('message_success','User updated.');
        return back();
    }
}
