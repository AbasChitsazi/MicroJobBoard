<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyjobApplicationController extends Controller
{

    public function index()
    {
        return view(
            'my_job_appliacation.index',
            [
                'applications' => auth()
                    ->user()
                    ->jobApplications()
                    ->with([
                        'job' => fn($q) => $q->withCount('jobApplications')->withAvg('jobApplications','expected_salary'),
                        'job.employer'
                        ])
                    ->latest()
                    ->get()
            ],
        );
    }

    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();
        return redirect()->back()->with('success','Job Application Removed');
    }
}
