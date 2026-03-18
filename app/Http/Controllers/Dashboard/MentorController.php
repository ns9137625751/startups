<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class MentorController extends Controller
{
    public function index()
    {
        return view('dashboard.mentor.index');
    }
}
