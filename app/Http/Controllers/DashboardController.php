<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Message;
use App\Models\Service;
use App\Models\SocialMedia;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // In your DashboardController.php file
    public function index()
    {
        $memberCount = \App\Models\TeamMember::count();
        $clientCount = \App\Models\Client::count();
        $serviceCount = \App\Models\Service::count();
        $testimonialCount = \App\Models\Testimonial::count();
        $socialMediaCount = \App\Models\SocialMedia::count();

        // Get recent messages (keeping this as it's already in your controller)
        $recentMessages = \App\Models\Message::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // These are the lines you need to add for pending messages
        $pendingMessages = \App\Models\Message::where('reply', null)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $pendingMessagesCount = \App\Models\Message::where('reply', null)->count();

        // I see you're already tracking unread messages
        $unreadMessagesCount = \App\Models\Message::where('reply', null)->count();

        return view('backend.content.dashboard', compact(
            'memberCount',
            'clientCount',
            'serviceCount',
            'testimonialCount',
            'socialMediaCount',
            'recentMessages',
            'unreadMessagesCount',
            'pendingMessages',        // Add this line
            'pendingMessagesCount'    // Add this line
        ));
    }
}
