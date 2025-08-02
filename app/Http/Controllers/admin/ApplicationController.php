<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = $request->query('search');

        $jobApplications = JobApplication::with(['user', 'job.employer'])
            ->filter($search)
            ->when(in_array($filter, ['approved', 'declined', 'pending']), function ($query) use ($filter) {
                if ($filter === 'approved') {
                    $query->where('is_approved', '1');
                } elseif ($filter === 'declined') {
                    $query->where('is_approved', '0');
                } elseif ($filter === 'pending') {
                    $query->whereNull('is_approved');
                }
            })
            // ->latest()
            ->paginate(20)
            ->appends($request->only('filter', 'search'));

        return view('admin.application', compact('jobApplications', 'filter', 'search'));
    }
}
