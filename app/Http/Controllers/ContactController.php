<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact.form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('admin@example.com')
                ->from($request->email)
                ->subject('お問い合わせ: ' . $request->name);
        });

        return redirect()->route('contact.form')->with('success', 'お問い合わせを送信しました');
    }
}
