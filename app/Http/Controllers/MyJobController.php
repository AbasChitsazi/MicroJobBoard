<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{

    public function index()
    {
        return view('my_job.index',
        [
            'jobs' => auth()
            ->user()
            ->employer
            ->jobs()
            ->with([
                'employer',
                'jobApplications',
                'jobApplications.user'
                ])
            ->get()
        ],

    );
    }

    public function create()
    {
        return view('my_job.create');
    }

    public function store(JobRequest $request)
    {
        $validated_data = $request->validated();
        auth()->user()->employer->jobs()->create($validated_data);

        return redirect()->route('my-jobs.index')->with('success','Job Created successfully');
    }

    public function edit(Job $myJob)
    {
        return view('my_job.edit',['job' => $myJob]);
    }

    public function update(JobRequest $request, Job $myJob)
    {
        $validated_data = $request->validated();
        $myJob->update($validated_data);

        return redirect()->route('my-jobs.index')->with('success','Job updated successfully');
    }

}
