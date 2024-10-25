<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\MailConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('client.contact.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'images' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = null;
        if ($request->hasFile('images')) {
            $images = $request->file('images')->store('uploads/images', 'public');
        }

        Mail::to('hoan2k4000@gmail.com')->send(new MailConfirm($validatedData, $images));

        return redirect()->route('client.contact')->with('success', 'Bạn đã gửi thành công!');
    }
}
