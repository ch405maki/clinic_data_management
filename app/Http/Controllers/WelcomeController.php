<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome/Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => App::version(),
            'phpVersion' => PHP_VERSION,
            // Pass the necessary navigation data here
            'navigation' => [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
            ]
        ]);
    }
    public function about()
    {
        return Inertia::render('Welcome/About', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => App::version(),
            'phpVersion' => PHP_VERSION,
            // Pass the necessary navigation data here
            'navigation' => [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
            ]
        ]);
    }
}

