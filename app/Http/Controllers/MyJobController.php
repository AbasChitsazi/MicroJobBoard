<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyJobController extends Controller
{

    use AuthorizesRequests;


    public function index()
    {

        $this->authorize('viewAnyEmployer', Job::class);

        $status = request('status');

        $jobsQuery = auth()
            ->user()
            ->employer
            ->jobs()
            ->with([
                'employer',
                'jobApplications',
                'jobApplications.user',
            ])
            ->withTrashed();

        if ($status === 'active') {
            $jobsQuery->whereNull('deleted_at');
        } elseif ($status === 'deleted') {
            $jobsQuery->onlyTrashed();
        }

        $jobs = $jobsQuery->latest()->get();

        return view('my_job.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Job::class);
        return view('my_job.create');
    }

    public function store(JobRequest $request)
    {
        $this->authorize('create', Job::class);

        $validated_data = $request->validated();
        auth()->user()->employer->jobs()->create($validated_data);

        return redirect()->route('my-jobs.index')->with('success', 'Job Created successfully');
    }

    public function edit(Job $myJob)
    {
        $this->authorize('update', $myJob);

        return view('my_job.edit', ['job' => $myJob]);
    }

    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize('update', $myJob);

        $validated_data = $request->validated();
        $myJob->update($validated_data);

        return redirect()->route('my-jobs.index')->with('success', 'Job updated successfully');
    }
    public function destroy(Job $myJob)
    {
        $myJob->delete();
        return redirect()->route('my-jobs.index')->with('success', 'Job Deleted Successfully');
    }
    public function downloadcv(JobApplication $application)
    {

        if (is_null($application->job)) {
            abort(404);
        }
        $this->authorize('downloadcv', $application);

        $path = $application->cv_path;

        if (!$path || !Storage::disk('private')->exists($path)) {
            abort(404);
        }

        return Storage::disk('private')->download($path, basename($path));
    }
}
