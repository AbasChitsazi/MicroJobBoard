<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyjobApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Middleware\Employer;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('jobs.index'));


Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

    // login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');

    // register page
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');

    // forgot password

Route::prefix('forgot')->group(function(){
    Route::get('password',[ForgotPasswordController::class,'showLinkRequest'])->name('password.request');
    Route::post('password',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});


Route::delete('logout', fn() => to_route('auth.destroy'))
    ->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');


Route::middleware('auth')->group(function(){
    Route::resource('job.application', JobApplicationController::class)
    ->only(['create','store']);

    Route::resource('my-job-applications',MyjobApplicationController::class)
    ->only(['index','destroy']);

    Route::resource('employer',EmployerController::class)
    ->only(['store','create']);

    Route::middleware(Employer::class)->resource('my-jobs',MyJobController::class);

    Route::get('download-cv/{application}',[MyJobController::class,'downloadcv'])->name('download-cv');

    Route::get('profile',[AuthController::class,'showProfile'])->name('auth.profile');
    Route::get('profile/edit',[AuthController::class,'showEditProfile'])->name('auth.profile.edit');
    Route::post('edit',[AuthController::class,'updateProfile'])->name('auth.profile.update');

});

Route::fallback(function(){
    return response()->view('404.index', [], 404);
});
