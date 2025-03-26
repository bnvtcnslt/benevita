<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $memberCount = TeamMember::count();
        $clientCount = Client::count();
        $serviceCount = Service::count();
        return view('backend.content.dashboard',compact('memberCount','clientCount','serviceCount'));
    }
}
