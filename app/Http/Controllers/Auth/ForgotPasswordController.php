<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ResetsPasswords;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
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
