<?php

namespace App\Http\Controllers;

use App\Mail\UserNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;

class AdminMailController extends Controller
{
    public function showForm()
    {
        $users = Users::select('id', 'email')->get();
        return view('sendMail', compact('users'));
    }
    

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $details = [
            'subject' => $request->subject,
            'title' => 'Message from R Menu Admin',
            'body' => $request->message,
        ];


        if ($request->email === 'all') {
            $users = Users::select('email')->get();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new UserNotificationMail($details));
            }

            return back()->with('success', 'Mail sent successfully to all users.');
        }

        
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($request->email)->send(new UserNotificationMail($details));
            return back()->with('success', 'Mail sent successfully to ' . $request->email);
        }

        return back()->with('error', 'Invalid email address.');
    }
}
