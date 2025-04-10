<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // @desc Update profile info
    // @route PUT /profile

    public function update(Request $request): RedirectResponse
    {
        // Get the logged-in user
        $user = Auth::user();

        // Validate incoming data, including email uniqueness check for the current user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ensure the email is unique, except for the current user
            ],
            'avatar' =>'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        // If password is provided, validate and hash it
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed', // Ensure password is strong enough
            ]);

            // Hash the new password and update
            $user->password = bcrypt($request->password); // Or use Hash::make() as an alternative
        }

        // Get user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle avatar upload

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if($user->avatar){
                Storage::delete('public/' .$user->avatar);
            }

            // Store new avatar
            $avatarPath =$request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }


        // Update user info
        // $user->update($validatedData);
        $user->save();

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Profile info updated');
    }
}
