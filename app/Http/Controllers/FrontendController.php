<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\SocialMedia;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $clients = Client::where('status', true)->get();
        $services = Service::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients->take(7 - $clients->count()));
        }

        $featuredTestimonials = Testimonial::with(['client' => function($query) {
            $query->whereNotNull('name')->where('status', true);
        }])
            ->where('status', true)
            ->orderBy('order')
            ->get()
            ->filter(function($testimonial) {
                return $testimonial->client !== null;
            });

        $social_media = SocialMedia::where('status', true)->get();

        return view('frontend.home', compact('clients', 'services', 'social_media', 'featuredTestimonials'));
    }

    public function about() {
        $members = TeamMember::all();
        $social_media = SocialMedia::where('status', 1)->get();
        return view('frontend.about', compact('members', 'social_media'));
    }

    public function services() {
        $clients = Client::where('status', true)->get();
        $services = Service::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        if ($clients->count() < 7) {
            $clients = $clients->concat($clients->take(7 - $clients->count()));
        }

        $featuredTestimonials = Testimonial::with(['client' => function($query) {
            $query->whereNotNull('name')->where('status', true);
        }])
            ->where('status', true)
            ->orderBy('order')
            ->get()
            ->filter(function($testimonial) {
                return $testimonial->client !== null;
            });

        $social_media = SocialMedia::where('status', true)->get();

        return view('frontend.services', compact('clients', 'services', 'social_media', 'featuredTestimonials'));
    }

    public function create() {
        $social_media = SocialMedia::where('status', 1)->get();
        $services = Service::all();
        return view('frontend.messages', compact('social_media', 'services'));
    }
    public function frontend()
    {
        $social_media = SocialMedia::where('status', 1)->get();
        $services = Service::all();
        return view('layouts.frontend', compact('social_media', 'services'));
    }
}
