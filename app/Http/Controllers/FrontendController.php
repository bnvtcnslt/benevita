<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home() {
        return view('frontend.home');
    }

    public function about() {
        return view('frontend.about');
    }

    public function services() {
        return view('frontend.services');
    }

    public function contact() {
        return view('frontend.contact');
    }
}
