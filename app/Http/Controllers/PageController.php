<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function ecosystem()
    {
        return view('pages.ecosystem');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function join()
    {
        return view('pages.join');
    }

    public function resources()
    {
        return view('pages.resources');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
