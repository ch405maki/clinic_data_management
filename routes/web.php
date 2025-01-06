<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;


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

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('/logout');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');


require __DIR__.'/auth.php';
