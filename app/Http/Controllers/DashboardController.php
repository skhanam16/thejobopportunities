<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // @desc Show all users job listings
    // @route GET /dashboard
    // import View

    public function index(): View
    {
        // Gets the currently authenticated user. The logged in user
        $user = Auth::user();

        // Get the user listings
        $jobs =Job::where('user_id', $user->id)->with('applicants')->get();

        // dd($jobs);
        return view('dashboard.index', compact('user', 'jobs'));
    }

}
