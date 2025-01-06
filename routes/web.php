<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;


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

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('/logout');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');


require __DIR__.'/auth.php';
