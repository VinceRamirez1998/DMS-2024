<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\NewsAndEvents;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Fetch all announcements and news/events
        $announcements = Announcement::all();
        $newsAndEvents = NewsAndEvents::all();
        
        // Define the default section
        $section = 'announcements'; // or whatever default you want
    
        // Return the welcome view with announcements and section
        return view('welcome', compact('announcements', 'newsAndEvents', 'section'));
    }
    

    public function verificationNotice(Request $request)
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
