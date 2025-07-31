<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Session\Middleware\AuthenticateSession;

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

        $key = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', "Too many login attempts. Try again in {$seconds} seconds.");
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($key);
            return redirect()->intended('/');
        }


        RateLimiter::hit($key, 300);

        return redirect()->back()->with('error', 'Invalid Credentials!');
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
        $user = auth()->user();

        $validData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|min:8|confirmed',

        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('auth.profile.edit')->with('error', 'current password is invalid');
            }

            $user->password = Hash::make($request->new_password);
        }


        $user->name = $validData['name'];
        $user->email = $validData['email'];

        $user->save();

        return redirect()->route('auth.profile')->with('success', 'Your profile updated successfully');
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
