<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('job.index');
    return view('welcome');
});


Route::resource('job',JobController::class);
