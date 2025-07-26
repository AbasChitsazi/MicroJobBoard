<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyjobApplicationController extends Controller
{

    public function index()
    {
        return view(
            'my_job_appliacation.index',
            [
                'applications' => auth()
                    ->user()
                    ->job_applications()
                    ->with('job','job.employer')
                    ->latest()
                    ->get()
            ],
        );
    }

    public function destroy(string $id)
    {
        //
    }
}
