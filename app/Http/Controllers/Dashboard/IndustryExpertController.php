<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndustryExpertController extends Controller
{
    public function index()
    {
        return view('dashboard.industry-expert.index');
    }
}
