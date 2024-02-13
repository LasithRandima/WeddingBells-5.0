<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return view('common.contactus');
    }


    public function sendEmail(Request $request)
    {
        // dd($request->all());
        $details = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,

        ];

        Mail::to('reachout.weddingbells@gmail.com')->send(new ContactMail($details));
        return back()->with('message_sent', 'Your message has been sent successfully!');
}
}
