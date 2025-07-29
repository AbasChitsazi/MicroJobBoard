<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function destroy($id)
{
    $userId = auth()->id();
    $currentSessionId = session()->getId();

    if ($id === $currentSessionId) {
        return back()->with('error', 'You cannot delete your current session.');
    }

    DB::table('sessions')
        ->where('user_id', $userId)
        ->where('id', $id)
        ->delete();

    return back()->with('success', 'The selected session has been logged out.');
}
}
