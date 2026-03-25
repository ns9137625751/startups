<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'organization' => $request->organization,
            'message'      => $request->message,
        ]);

        return back()->with('success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
