<?php
namespace App\Http\Controllers;


use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployerController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        if (!auth()->user()->can('is_verified')) {
    return redirect()->route('auth.profile')->with('error', 'For Access to Create Your Own Job Plaese Verify Your Email');
}
        $this->authorize('create', Employer::class);
        return view('employer.create');
    }

    public function store(Request $request)
    {
        $this->authorize('is_verified');
        $this->authorize('create', Employer::class);

        auth()->user()->employer()->create(
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name'
            ])
        );

        return redirect()->route('my-jobs.index')->with('success','Your employer account was created!');
    }
}
