<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny',Job::class);
        $filters = request()->only(['search', 'min_salary', 'max_salary', 'category', 'experience']);

        return view('job.index', ['jobs' => Job::with('employer')->latest()->filter($filters)->paginate(20)->withQueryString()]);
    }

    public function show(Job $job)
    {


        $this->authorize('view',$job);

        $job->load(['employer' => function ($query) use ($job) {
            $query->with(['jobs' => function ($q) use ($job) {
                $q->where('id', '!=', $job->id);
            }]);
        }]);
        return view('job.show', ['job' => $job]);
    }

}
