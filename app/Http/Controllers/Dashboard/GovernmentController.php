<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class GovernmentController extends Controller
{
    public function index()
    {
        return view('dashboard.government.index');
    }
}
