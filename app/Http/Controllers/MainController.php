<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users_db;

class MainController extends Controller
{
    //this is the main controler made using the command php artisan make:controller MainController
    //login section below
    public function login () {
        return view('login');
    }

    public function login_fun(Request $request) {
        $email= $request->input('email');
        $password = $request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        try {
            $user = users_db::where('email', $email)->first();
            if(!$user || $password != $user->password) {
                return back()->with('fail', 'We do not recognize your email or password');
            } else {
                $request->session()->put('LoggedUser', $user->id);
                return redirect('/home');
            }
        } catch (\Exception $e) {
            return back()->with('fail', 'Something went wrong');
        }


        
    }



    //register section below
    public function register () {
        return view('register');
    }

    
    public function register_fun(Request $request) {
        // Validate request
        // dd($request->all());    
        $request->validate([
            'name' => 'required|min:4|max:50',
            'email' => 'required|email|unique:users_info,email',
            'password' => 'required|min:6|confirmed'
        ]);
    
        try {
            // Create new user
            $user = new users_db();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password =$request->input('password');
            $user->save();
    
            // Store user session
            // $request->session()->put('LoggedUser', $user->id);
    
            return redirect('/login')->with('success', 'Registration successful!'); 
        } catch (\Exception $e) {
            return back()->with('fail', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
}
