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
}
