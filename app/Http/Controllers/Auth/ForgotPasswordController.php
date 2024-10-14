<?php

namespace App\Http\Controllers\Auth;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\NewsAndEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ForgotPasswordController extends Controller
{
    use ResetsPasswords;

    public function showLinkRequestForm()
    {
        // Fetch all announcements and news/events
        $announcements = Announcement::all();
        $newsAndEvents = NewsAndEvents::all();
        
        // Define the default section
        $section = 'announcements'; // or whatever default you want
    
        // Return the view with the fetched data, including the section
        return view('auth.passwords.email', compact('announcements', 'newsAndEvents', 'section'));
    }

    
    public function sendResetLinkEmail(Request $request)
    {
        // If an email is provided, store it in the session
        if (!empty($request->email)) {
            $request->session()->put('forgotemail', $request->email);
        }
    
        // Retrieve the email from the request or from the session
        $email = $request->input('email') ?: $request->session()->get('forgotemail');
    
        // Validate the email
        if (empty($email)) {
            return back()->withErrors(['email' => 'Email address is required.']);
        }
    
        $request->merge(['email' => $email]); // Ensure the request contains the email for validation
        $request->validate(['email' => 'required|email']);
    
        // Send the reset link
        $response = Password::sendResetLink(['email' => $email]);
    
        // Handle the response
        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', __('We have emailed your password reset link!'))
            : back()->withErrors(['email' => __($response)]);
    }
}
