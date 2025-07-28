<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|min:5|max:128',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials!');
        }
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email|min:5|max:128',
            'password' => 'required|min:6|confirmed'
        ]);

        $created_user = User::create([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password'])
        ]);
        if ($created_user) {
            Auth::login($created_user);
            return redirect()->route('jobs.index');
        }
        return back()->with('error', 'sign up failed please try again');
    }
    public function destroy()
    {
        Auth::logout();
        $this->deleteExpiredResetTokens();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
    public function deleteExpiredResetTokens()
    {
        DB::table('password_resets')
            ->where('created_at', '<', Carbon::now()->subMinutes(5))
            ->delete();
    }
    public function showProfile()
    {
        return view('auth.profile.index');
    }
    public function showEditProfile()
    {
        return view('auth.profile.edit');
    }
    public function updateProfile(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ]);

        $updated = auth()->user()->update([
            'name' => $validData['name'],
            'email' => $validData['email'],
        ]);

        if ($updated) {
            return redirect()->route('auth.profile')->with('success', 'Your profile updated successfully');
        }

        return back()->with('error', 'Failed to update profile');
    }
    public function editCompany()
    {
        return view('auth.profile.editcompany');
    }
    public function updateCompany(Request $request)
    {
        $validData = $request->validate([
            'company_name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('employers', 'company_name')
                    ->ignore(auth()->user()->id, 'user_id')
            ],
        ]);

        DB::table('employers')
            ->where('user_id', auth()->user()->id)
            ->update(['company_name' => $validData['company_name']]);

        return redirect()->route('auth.profile')->with('success', 'Company name updated successfully');
    }
}
