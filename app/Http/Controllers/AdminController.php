<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AdminController extends Controller
{
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/panel');
    }
    public function dashboard()
    {
        $latestJobs = Job::take(3)->latest()->get();
        $latestusers = User::take(3)->latest()->get();
        $latestapllied = JobApplication::take(3)->latest()->get();
        return view('admin.dashboard', compact('latestJobs', 'latestusers', 'latestapllied'));
    }
    public function users(Request $request)
    {

        $filter = $request->query('filter');
        $search = $request->query('search');

        $users = User::query()
            ->when($filter === 'employer', fn($query) => $query->whereHas('employer'))
            ->when($filter === 'jobseeker', fn($query) => $query->whereDoesntHave('employer'))
            ->filter($search)
            ->paginate(20)
            ->withQueryString();

        return view('admin.users', compact('users', 'filter', 'search'));
    }
    public function showUser(User $user)
    {

        return view('admin.showUsers', compact('user'));
    }
    
}
