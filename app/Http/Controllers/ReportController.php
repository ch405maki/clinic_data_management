<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\IndividualRecord;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    const ROLES = [
        'Admin' => 1,
        'Doctor' => 2,
        'Nurse' => 3,
        'Patient' => 4,
    ];

    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Return the view with the fetched data
        return Inertia::render('Report/Index', [
        ]);
        
    }
}
