<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function auth(Request $request){
        $email=$request->email;
        $password=$request->password;
        $values=['email'=>$email,"password"=>$password];
        if(Auth::attempt($values)){
           if(Auth::user()->email_verified_at !==null){
               $request->session()->regenerate();
               return to_route('users.index')->with('success','Successfully authentificated');
           }else{
               Auth::logout();
               return back()->with(['error' => 'Your email is not verified,verify your account !']);
           }

        }else{
            return back()->withErrors(['email' => 'These credentials do not match our records.'])
                ->withInput($request->only('email')) ;
        }
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return to_route('login');
    }
}
