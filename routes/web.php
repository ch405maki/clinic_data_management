<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorAvailabilityController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\IndividualRecordController;


Route::get('/', [WelcomeController::class, 'index'])->name('mainpage');
Route::get('about', [WelcomeController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [UserController::class, 'admin'])->name('admin.index');
    Route::get('/doctor', [UserController::class, 'doctor'])->name('doctor.index');
    Route::get('/nurse', [UserController::class, 'nurse'])->name('nurse.index');
    Route::get('/patient', [UserController::class, 'patient'])->name('patient.index');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('availability', [DoctorAvailabilityController::class, 'index'])->name('availability.index');
    Route::post('availability', [DoctorAvailabilityController::class, 'store'])->name('availability.store');
    Route::delete('availability/{id}', [DoctorAvailabilityController::class, 'destroy'])->name('availability.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/diagnose', [IndividualRecordController::class, 'index'])->name('diagnose.index');
    Route::get('/diagnose/{user}', [IndividualRecordController::class, 'create'])->name('diagnose.create');
    Route::post('/diagnose', [IndividualRecordController::class, 'store'])->name('diagnose.store');

});

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('/logout');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');


require __DIR__.'/auth.php';
