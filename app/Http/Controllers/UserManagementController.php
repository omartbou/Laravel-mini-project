<?php

namespace App\Http\Controllers;

use App\Mail\GeneratedPasswordEmail;
use App\Mail\RegisterConfirmationMail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{

    public function index(){
        $users=User::all();
        return view('hello',compact('users'));
    }
    public function create(){
        return view('add_user');
    }
    public function store(Request $request){
        $rules=[
            'name'=>'required|string|max:50',
            'email'=>'required|string|max:255|unique:users',
            'phone'=>'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $generatedPassword = Str::random(8);
        $hashedPassword = Hash::make($generatedPassword);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$hashedPassword,
        ]);
        Mail::to($user->email)->send(new GeneratedPasswordEmail($generatedPassword));
        Mail::to($user->email)->send(new RegisterConfirmationMail($user));
        return redirect()->route('users.index')->with('success','The user has been added successfully');
    }
    public function edit(User $user){
        return view('edit',compact('user'));
    }
    public function update(Request $request,$id){
        $user = User::findOrFail($id);
        $rules=[
            'name'=>'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone'=>'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->update($request->all());
        return redirect()->route('users.index')->with('success','The user has been updated succcessfully');
    }
    public function destroy(User $user){

        $user->delete();
        return redirect()->route('users.index')->with('success','The user has been deleted successfully');
    }
    //
}
