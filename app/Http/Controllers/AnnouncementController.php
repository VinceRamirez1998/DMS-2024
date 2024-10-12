<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Fetch all announcements
        $announcements = Announcement::all();
        
        // Return the welcome view with announcements
        return view('welcome', compact('announcements'));
    }
}
