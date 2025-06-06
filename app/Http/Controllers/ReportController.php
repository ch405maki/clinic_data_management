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

        // Fetch IndividualRecords based on user role
        if ($user->role === 'Patient') {
            $records = IndividualRecord::with('patient')
                ->where('patient_id', $user->id)
                ->get();
        } else {
            $records = IndividualRecord::with('patient')
                ->get()
                ->unique('patient_id');
        }

        // Return the view with the fetched data
        return Inertia::render('Report/Index', [
            'records' => $records,
            'userRole' => $user->role,
        ]);
    }

    public function history($patientId)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch patient records with associated data
        $records = IndividualRecord::with(['patient'])
            ->where('patient_id', $patientId)
            ->get();
            

        $user = $records->first()->patient;

        // Return the view with the fetched data
        return Inertia::render('Report/History', [
            'records' => $records,
            'user' => $user,
            'userRole' => auth()->user()->role,
        ]);
    }
}