<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyjobApplicationController extends Controller
{

public function index()
{
    $status = request('status'); 

    $applicationsQuery = auth()->user()->jobApplications()
        ->with([
            'job' => function ($q) {
                $q->withTrashed()
                  ->withCount('jobApplications')
                  ->withAvg('jobApplications', 'expected_salary');
            },
            'job.employer',
        ])
        ->latest();

    if ($status === 'active') {
        $applicationsQuery->whereHas('job', fn($q) => $q->whereNull('deleted_at'));
    } elseif ($status === 'deleted') {
        $applicationsQuery->whereHas('job', fn($q) => $q->onlyTrashed());
    }

    return view('my_job_appliacation.index', [
        'applications' => $applicationsQuery->get(),
    ]);
}



    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();
        return redirect()->back()->with('success', 'Job Application Removed');
    }
}
