<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    public function index()
    {
        // Fetch the latest 8 notices
        $notices = NoticeBoard::orderBy('created_at', 'desc')->take(8)->get();
        
        // Return the dashboard view with notices
        return view('dashboard', compact('notices')); // Ensure this matches your view file
    }
}
