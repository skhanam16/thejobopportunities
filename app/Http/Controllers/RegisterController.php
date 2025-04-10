<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    // Return the 'auth.register' view
    // @desc Show register form
    // @route GET /register
    public function register(): View
    {
   
        return view('auth.register');
    }

    // @desc Store user in database
    // @route POST /register

    public function store(Request $request): RedirectResponse
    {
     $validatedData =$request->validate([
        'name' =>'required|string|max:100',
        'email' =>'required|string|email|unique:users',
        'password' =>'required|string|min:8|confirmed',
     ]);

     // Hash password
     $validatedData['password'] =Hash::make($validatedData['password']);

     // Create user

     $user = User::create($validatedData);
     return redirect()->route('login')->with('success', 'You are registered. You can login!');
    
    }


   
}
