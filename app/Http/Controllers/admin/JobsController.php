<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();


        if ($request->filled('filterbyjob')) {
            $query->where('category', $request->filterbyjob);
        }


        if ($request->filled('filterbyexperience')) {
            $query->where('experience', $request->filterbyexperience);
        }


        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $search = '%' . $request->search . '%';

                $q->where('title', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search)
                    ->orWhereHas('employer', function ($employerQuery) use ($search) {
                        $employerQuery->where('company_name', 'LIKE', $search)
                            ->orWhereHas('user', function ($userQuery) use ($search) {
                                $userQuery->where('name', 'LIKE', $search);
                            });
                    });
            });
        }


        $jobs = $query->paginate(20)->appends($request->query());

        return view('admin.jobs', compact('jobs'));
    }
}
