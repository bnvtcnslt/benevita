<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Team;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home() {
        $clients = Client::all();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients);
        }
        return view('frontend.home', compact('clients'));
    }

    public function about() {
        $teams = Team::all();
        return view('frontend.about', compact('teams'));
    }

    public function services() {
        $clients = Client::all();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients);
        }
        return view('frontend.services', compact('clients'));
    }

    public function contact() {
        return view('frontend.contact');
    }
}
