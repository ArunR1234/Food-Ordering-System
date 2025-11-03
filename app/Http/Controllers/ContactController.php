<?php

namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{
     public function contact(){
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);


        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

       
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
