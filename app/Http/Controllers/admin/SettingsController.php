<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }
    public function store(Request $request)
    {
        $validata = $request->validate([
            'name' => 'required|min:3|max:128',
            'email' => 'required|email|min:5|max:128|unique:users,email',
            'password' => 'required|min:8|max:128'
        ]);

        $created_admin = User::create([
            'email' => $validata['email'],
            'name' => $validata['name'],
            'password' => Hash::make($validata['password']),
            'is_verified' => 1,
            'role' => 'admin',
            'is_locked' => 0
        ]);
        if($created_admin){
            return back()->with('success','Admin Successfully created');
        }
    }
}
