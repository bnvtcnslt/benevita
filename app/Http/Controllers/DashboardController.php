<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Team;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $teamCount = Team::count();
        $clientCount = Client::count();
        return view('backend.content.dashboard',compact('teamCount','clientCount'));
    }
}
