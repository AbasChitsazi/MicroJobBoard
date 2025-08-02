<?php

use App\Http\Middleware\Employer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ApplicationController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyjobApplicationController;

Route::get('', fn() => to_route('jobs.index'));


Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);


// login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');

// register page
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');

// forgot password

Route::prefix('forgot')->group(function () {
    Route::get('password', [ForgotPasswordController::class, 'showLinkRequest'])->name('password.request');
    Route::post('password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});


// Authenticated Routes
Route::middleware('auth')->group(function () {


    Route::delete('auth', [AuthController::class, 'destroy'])
        ->name('auth.destroy');


    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyjobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['store', 'create']);

    Route::middleware(Employer::class)->resource('my-jobs', MyJobController::class);

    Route::post('my-jobs-status', [MyJobController::class, 'myJobsStatus'])->name('myjobs-status');

    Route::get('download-cv/{application}', [MyJobController::class, 'downloadcv'])->name('download-cv');

    Route::get('profile', [AuthController::class, 'showProfile'])->name('auth.profile');
    Route::get('profile/edit', [AuthController::class, 'showEditProfile'])->name('auth.profile.edit');
    Route::post('edit', [AuthController::class, 'updateProfile'])->name('auth.profile.update');
    Route::get('profile/edit-company', [AuthController::class, 'editCompany'])->name('auth.company.edit');
    Route::post('profile/edit-company', [AuthController::class, 'updateCompany'])->name('auth.company.update');

    Route::delete('/sessions/{id}', [SessionController::class, 'destroy'])->name('sessions.destroy');

    Route::post('verify/email/send', [AuthController::class, 'SendVerifyEmail'])->name('auth.verify.create.token');
    Route::get('verify/{hash}', [AuthController::class, 'verifyToken'])->name('auth.verify.token');
});




Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {


    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('users', [UsersController::class, 'users'])->name('admin.users');
    Route::get('users/{user}', [UsersController::class, 'showUser'])->name('admin.show.user');
    Route::get('users/{user}/edit', [UsersController::class, 'showEditUser'])->name('admin.edit.user');
    Route::post('users/{user}/update', [UsersController::class, 'UpdateUser'])->name('admin.update.user');
    Route::delete('users/{user}/delete', [UsersController::class, 'deleteUser'])->name('admin.delete.user');
    Route::post('lock/{user}',[UsersController::class,'toggleLock'])->name('admin.lock.user');
    Route::get('application',[ApplicationController::class,'index'])->name('admin.application.index');
    Route::get('jobs',[JobsController::class,'index'])->name('admin.jobs.index');
    Route::get('settings',[SettingsController::class,'index'])->name('admin.setting.index');
    Route::post('settings',[SettingsController::class,'store'])->name('admin.settings.create.admin');
});



Route::fallback(function () {
    return response()->view('404.index', [], 404);
});
