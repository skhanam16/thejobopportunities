<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(): View
    {
       // @desc Show login form
        // @route GET /login
        return view('auth.login');
    }

  
    // @desc Authenticate User
    // @route POST /login

    public function authenticate(Request $request): RedirectResponse
{
    // Validate the credentials
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Regenerate the session to prevent fixation attack
        $request->session()->regenerate();

        // Redirect to the intended page after login
        return redirect()->intended(route('home'))->with('success', 'You are now logged in');
    }

    // If authentication fails, redirect back with error
    return back()->withErrors([
        'email' => 'The provided credentials are incorrect.',
    ])->onlyInput('email');
}

    // @desc Logout User
    // @route POST /logout
public function logout(Request $request): RedirectResponse
{
   Auth::logout();
   $request->session()->invalidate();
   $request->session()->regenerateToken();
    return redirect('/');
}


}
