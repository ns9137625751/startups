<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        DB::table('contacts')->insert([
            'name'         => $request->name,
            'email'        => $request->email,
            'organization' => $request->organization,
            'message'      => $request->message,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return back()->with('success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
