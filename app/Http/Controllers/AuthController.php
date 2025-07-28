<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        if($created_user){
            Auth::login($created_user );
            return redirect()->route('jobs.index');
        }
        return back()->with('error', 'sign up failed please try again');

    }
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
