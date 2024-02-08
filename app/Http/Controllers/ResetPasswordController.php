<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Show the form to request a password reset link.
     */
    public function index()
    {
        return view('requestPassword');
    }

    /**
     * Send a password reset email to the user.
     */
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email', $request->email)->first();

        $token = Str::random(64);
        $expiration = Carbon::now()->addHours(1);

        DB::table('password_resets')->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => Carbon::now(),
            'expires_at' =>$expiration,
        ]);

        Mail::send('emails.email_reset_password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect('/')->with('success', 'We have e-mailed your password reset link!');

    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(string $token)
    {
        return view('resetForm',['token' => $token]);
    }

    /**
     * Reset the user's password.
     */
    public function reset(Request $request)
    {$request->validate([
        'password' => 'required|string|min:6|confirmed',
        'token' => 'required|string'
    ]);

        // Retrieve the record from the password_resets table
        $resetRecord = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        // Check if the reset record exists
        if (!$resetRecord) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        if (Carbon::now()->gt($resetRecord->expires_at)) {
            return redirect('/')->with('message','the link has been expired');
        }
        // Retrieve the user based on the email in the reset record
        $user = User::find($resetRecord->user_id);

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the reset record from the password_resets table
        DB::table('password_resets')->where('token', $request->token)->delete();
        Mail::send('emails.newPassword_confirmation', [], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('New Password Confirmation');
        });
        return redirect('/')->with('success', 'Your password has been changed successfully!');
    }
}
