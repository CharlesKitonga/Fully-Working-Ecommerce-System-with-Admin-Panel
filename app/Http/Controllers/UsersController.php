<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use App\Contact;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->all();
            // echo "<pre>";print_r($data);die;
    		$user = new User;
    		$user->name = $data['name'];
    		$user->email = $data['email'];
            $user->number = $data['number'];
    		$user->password = bcrypt($data['password']);
    		$user->save();
    	}
    	return view('users.register')->with('flash_message_success','Registered Successfuly!');
    }
     public function login(Request $request){

        if ($request->isMethod('post')) {
            if (auth()->attempt(request(['email','password']))==true) {
                echo "success";die;
                // Session::put('adminSession',$data['email']);
                return redirect('index');
            }else{
                echo "Failed";die;
                return redirect('/admin')->with('flash_message_error','Invlaid Username or Password');
            }
        }
      
        return view('index');
    }
    public function contact(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $contacts = new Contact;
            $contacts->fname = $data['fname'];
            $contacts->lname = $data['lname'];
            $contacts->email = $data['email'];
            $contacts->subject = $data['subject'];
            $contacts->message = $data['message'];
            $contacts->save();
        }
        return view('contact')->with('flash_message_success','Thank youfor your Message. We will get back to you!');
    }
}
