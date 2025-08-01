<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            ->when($filter === 'jobseeker', fn($query) => $query->whereHas('jobApplications'))
            ->when($filter === 'admin', fn($query) => $query->where('role','admin'))
            ->filter($search)
            ->paginate(20)
            ->withQueryString();

        return view('admin.users', compact('users', 'filter', 'search'));
    }
    public function showUser(User $user)
    {

        return view('admin.showUsers', compact('user'));
    }
    public function showEditUser(User $user)
    {
        return view('admin.editUsers', compact('user'));
    }
    public function UpdateUser(Request $request, User $user)
    {

        $validData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if (!empty($validData['password'])) {
            $user->password = Hash::make($validData['password']);
        }

        $user->name = $validData['name'];
        $user->email = $validData['email'];

        $user->save();

        return redirect()->route('admin.show.user', $user)->with('success', "{$user->name} Updated Successfully");
    }
    public function deleteUser(User $user)
    {

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User Deleted Successfully');
    }
}
