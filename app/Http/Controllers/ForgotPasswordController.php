<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController extends Controller
{
    public function showLinkRequest()
    {
        return view('auth.forgot-password.show');
    }
    public function sendResetLinkEmail(Request $request)
    {

        $valid_email = $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $email = $valid_email['email'];

        $key = 'password-reset-request:' . $email;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', "Prevent From Sending Request too much. try again after $seconds seconds.");
        }

        RateLimiter::hit($key, 900);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        try {
            Mail::to($email)->queue(new PasswordResetMail($token, $email));
        } catch (Exception $e) {
            throw new Exception('Plaese activate Queue with command: php artisan queue:work');
        }

        return back()->with('success', 'A password reset link has been sent to your email.');


    }
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        $reset = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$reset) {
            return redirect()->route('password.request')
                ->with('error', 'Link is invalid');
        }

        if (Carbon::parse($reset->created_at)->addMinutes(5)->isPast()) {
            return redirect()->route('password.request')
                ->with('error', 'Link is Expired. Please try again to reset your password');
        }

        return view('auth.forgot-password.resetform', [
            'token' => $token,
            'email' => $email,
        ]);
    }
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $resetRequest = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRequest) {
            return back()->with('error', 'Link is invalid');
        }


        if (Carbon::parse($resetRequest->created_at)->addMinutes(5)->isPast()) {
            return back()->with('error', 'Link is Expired. Please try again to reset your password');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();


        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();


        return redirect()->route('auth.login')->with('success', 'Your password succeefully changed. Please Sign in');
    }
}
