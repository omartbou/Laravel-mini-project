<?php

namespace App\Http\Controllers;

use App\Mail\RegisterConfirmationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(){
    return view('register');
    }
    public function register(Request $request){
        $rules=[
            'name'=>'required|string|max:50',
            'email'=>'required|string|max:255|unique:users',
            'phone'=>'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'password'=>'required|string|min:8|confirmed',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'password' => Hash::make($request->password),
    ]);
    Mail::to($request->email)->send(new RegisterConfirmationMail($user));
    return redirect('/')->with('success', 'An Email has been sent to verify your account ');

    }
    public function verifyEmail(string $hash){
        [$createdAt,$id]=explode('///',base64_decode($hash));
        $user=User::findOrFail($id);
        if($user->created_at->toDateTimeString() !== $createdAt){
            abort(403);
        }
        if($user->email_verified_at !== null){
            return redirect('/')->with('success','Your account is already active');
        }
            $user->email_verified_at=now();
            $user->save();
            return redirect('/')->with('success','Your Account has been verified !');
    }

}
