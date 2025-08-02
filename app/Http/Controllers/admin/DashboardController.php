<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $latestJobs = Job::take(3)->latest()->get();
        $latestusers = User::take(3)->latest()->get();
        $latestapllied = JobApplication::take(3)->latest()->get();
        return view('admin.dashboard', compact('latestJobs', 'latestusers', 'latestapllied'));
    }
}
