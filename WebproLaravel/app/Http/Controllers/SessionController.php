<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirmation;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{
    function index(){
        return view('index');
    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email is required',
            'password.required'=>'Password is required'
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('home');
        }else{
            return redirect('')->withErrors('Incorrect email or password')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }

    function register(){
        return view('reg');
    }

    function create(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ],[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
            'email.email'=>'Email not valid',
            'email.unique'=>'Email already axist',
            'password.required'=>'Password is required',
            'password.min'=>'Password must be at least 6 characters'
        ]);

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ];

        User::create($data);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        Mail::to($request->email)->send(new RegistrationConfirmation($request));

        return redirect('');
    }
}
