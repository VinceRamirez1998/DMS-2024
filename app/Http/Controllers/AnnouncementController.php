<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\NewsAndEvents;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Fetch all announcements
        $announcements = Announcement::all();
        $newsAndEvents = NewsAndEvents::all();
        
        // Return the welcome view with announcements
        return view('welcome', compact('announcements', 'newsAndEvents'));
    }

    public function verify(Request $request)
    {
        // Fetch all announcements and news/events
        $announcements = Announcement::all();
        $newsAndEvents = NewsAndEvents::all();
        
        // Get the section from the request, defaulting to 'announcements'
        $section = $request->get('section', 'announcements');
        
        // Return the verify view with the fetched data
        return view('auth.verify', compact('announcements', 'newsAndEvents', 'section'));
    }
}
