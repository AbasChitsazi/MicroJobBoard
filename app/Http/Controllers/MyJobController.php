<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data =  $request->validate([
            'title' => 'required|min:5|max:255|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:5000|max:1000000',
            'description' => 'required|string',
            'experience' => 'required|in:' . implode(',', \App\Models\Job::$experience).'',
            'category' => 'required|in:' . implode(',', \App\Models\Job::$jobcategory).'',
        ]);
        auth()->user()->employer->jobs()->create($validated_data);

        return redirect()->route('my-jobs.index')->with('success','Job Created successfully');
    }

    public function edit(Job $myJob)
    {
        return view('my_job.edit',['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
