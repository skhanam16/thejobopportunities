<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Applicant;
use App\Models\Job;
use App\Mail\JobApplied;
use Illuminate\Support\Facades\Mail;


class ApplicantController extends Controller
{
    // @desc Store new job applicant
    // @route POST /jobs/{job}/apply

public function store(Request $request, Job $job): RedirectResponse
{

    // Check if the user has already appled
    $existingApplication = Applicant::where('job_id', $job->id)
                                    ->where('user_id', auth()->id())
                                    ->exists();
    if($existingApplication){
        return redirect()->back()->with('error', 'You have already applied to this job');
    }
 
   
    // Validate incoming data
    $validatedData = $request->validate([
        'full_name' => 'required|string',
        'contact_phone' => 'string',
        'contact_email' => 'required|string|email',
        'message' => 'string',
        'location' => 'string',
        'resume' => 'required|file|mimes:pdf|max:2048', // corrected 'mines' to 'mimes'
    ]);

    // Handle resume upload
    if ($request->hasFile('resume')) {
        $path = $request->file('resume')->store('resumes', 'public');
        $validatedData['resume_path'] = $path;
    }

    // Store the application to the database table
    $application = new Applicant($validatedData);
    $application->job_id = $job->id;
    $application->user_id = auth()->id();
    $application->save();

    // Send email to owner
    // Mail::to($job->user->email)->send(new JobApplied($application, $job));

    // Return a redirect response (e.g., to a thank you page or back to the form)
    return redirect()->back()->with('success', 'Application submitted successfully!');

}

public function destroy($id): RedirectResponse  
{
    $applicant = Applicant::findOrFail($id);
    $applicant->delete();
    return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully');
}

}