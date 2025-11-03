<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

   public function logstore(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ]);

    $user = Users::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Email not found.');
    }

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Incorrect password.');
    }


    session([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_role' => $user->role
    ]);


    switch ($user->role) {


        case 'admin':
            return redirect()->route('admin')->with('success', 'Admin login successful.');
        case 'chef':
            return redirect()->route('chef')->with('success', 'Chef login successful.');
        case 'customer':
            return redirect()->route('home')->with('success', 'Customer login successful.');
        default:
            return redirect()->route('login')->with('error', 'Invalid role assigned.');
    }
}


    public function register(){
        return view('register');
    }

    public function regstore(Request $request){

        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|regex:/^[\w\.-]+@[\w\.-]+\.com$/',
            'password' => 'required|min:6',
             'role'     => 'required|in:admin,chef,customer',
        ]);

        if(Users::where('email', $request->email)->exists()){
            return redirect()->back()->with('error', 'Email already exists.');
        }


        $data = $request->only(['name', 'email', 'role']);
        $data['password'] = Hash::make($request->password);


        Users::create($data);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

         public function logout()
{
    session()->forget(['user_id', 'user_name', 'user_role']);
    return redirect()->route('login')->with('success', 'Logged out successfully.');
}



    public function home(){
        $user = Users::find(session('user_id'));
        return view('home', ['user' => $user]);
    }

     public function about(){
        return view('about');

     }

//      public function forgotPassword()
// {
//     return view('forgot-password');
// }

// public function forgotPost(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required|min:6|confirmed',
//     ]);

//     $user = Users::where('email', $request->email)->first();

//     if (Hash::check($request->password, $user->password)) {
//         return back()->with('error', 'New password cannot same as old password.');
//     }

//     if (!$user) {
//         return back()->with('error', 'Email not found.');
//     }

//     $user->password = Hash::make($request->password);
//     $user->save();

//     return redirect()->route('login')->with('success', 'Password reset successfully.');
// }

public function forgotPassword()
{
    return view('forgot');
}

public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = Users::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email not found.');
    }

    $token = Str::random(64);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
    );

    $link = url("/reset/$token");
    $details = [
        'subject' => 'Password Reset Link',
        'title' => 'Reset Your Password',
        'body' => "Click the link below to reset your password:<br><a href='$link'>$link</a>"
    ];

    Mail::to($request->email)->send(new UserNotificationMail($details));

    return back()->with('success', 'Password reset link sent to your email.');
}

public function showResetForm($token)
{
    return view('reset-password', ['token' => $token]);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    $check = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$check) {
        return back()->with('error', 'Invalid or expired reset token.');
    }

    $user = Users::where('email', $request->email)->first();
    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    if (Hash::check($request->password, $user->password)) {
        return back()->with('error', 'New password cannot be the same as old password.');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password reset successfully. Please login.');
}


}

