<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {

        $filters = request()->only(['search', 'min_salary', 'max_salary', 'category', 'experience']);

        return view('job.index', ['jobs' => Job::with('employer')->filter($filters)->paginate(20)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['employer' => function ($query) use ($job) {
            $query->with(['jobs' => function ($q) use ($job) {
                $q->where('id', '!=', $job->id);
            }]);
        }]);
        return view('job.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
