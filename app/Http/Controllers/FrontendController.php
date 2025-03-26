<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SocialMedia;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home() {
        $clients = Client::all();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients);
        }
        $social_media = SocialMedia::where('status', 1)->get();
        return view('frontend.home', compact('clients', 'social_media'));
    }

    public function about() {
        $members = TeamMember::all();
        $social_media = SocialMedia::where('status', 1)->get();
        return view('frontend.about', compact('members', 'social_media'));
    }

    public function services() {
        $clients = Client::all();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients);
        }
        $social_media = SocialMedia::where('status', 1)->get();
        return view('frontend.services', compact('clients', 'social_media'));
    }

    public function contact() {
        $social_media = SocialMedia::where('status', 1)->get();
        return view('frontend.contact', compact('social_media'));
    }


    public function frontend()
    {
        $social_media = SocialMedia::where('status', 1)->get();
        return view('layouts.frontend', compact('social_media'));
    }
}
