<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;


class BookmarkController extends Controller
{
    // @desc Get all users bookmarks
    // @route GET /bookmarks

    public function index() : View 
    {
    $user = Auth::user();
    $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
    return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }


    // @desc Create new bookmarked job
    // @route POST /bookmarks/{job}

    public function store(Job $job): RedirectResponse 
    {

        // dd('store');
        $user = Auth::user();
        // Check if the job is alreay bookmarked
     if( $user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
return back()->with('error', 'Job is already bookmarked');
     }
// if it is not true then Create new bookmark
$user->bookmarkedJobs()->attach($job->id);
return back()->with('success', 'Job is bookmarked successfully');
    }


    
    // @desc Remove bookmarked job
    // @route DELETE /bookmarks/{job}

        public function destroy(Job $job): RedirectResponse 
        {
            $user = Auth::user();
            // Check if the job is not alreay bookmarked
         if( !$user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
    return back()->with('error', 'Job is not bookmarked');
         }
    // if it is not true then Create new bookmark
    // Remove bookmarked
    $user->bookmarkedJobs()->detach($job->id);
    return back()->with('success', 'Bookmarked removed successfully');
        }
}
