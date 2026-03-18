<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IncubatorController extends Controller
{
    public function index()
    {
        return view('dashboard.incubator.index');
    }
}
