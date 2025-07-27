<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyJobController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAnyEmployer',Job::class);
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
        $this->authorize('create',Job::class);
        return view('my_job.create');
    }

    public function store(JobRequest $request)
    {
        $this->authorize('create',Job::class);

        $validated_data = $request->validated();
        auth()->user()->employer->jobs()->create($validated_data);

        return redirect()->route('my-jobs.index')->with('success','Job Created successfully');
    }

    public function edit(Job $myJob)
    {
        $this->authorize('update',$myJob);

        return view('my_job.edit',['job' => $myJob]);
    }

    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize('update',$myJob);

        $validated_data = $request->validated();
        $myJob->update($validated_data);

        return redirect()->route('my-jobs.index')->with('success','Job updated successfully');
    }

}
