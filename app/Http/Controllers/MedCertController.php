<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\IndividualRecord;
use Inertia\Inertia;
use Illuminate\Http\Request;
class MedCertController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        $records = IndividualRecord::with('patient')
            ->get()
            ->unique('patient_id');
        
        // Return the view with the fetched data
        return Inertia::render('Certificate/Index', [
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
        return Inertia::render('Certificate/History', [
            'records' => $records,
            'user' => $user,
            'userRole' => auth()->user()->role,
        ]);
    }

    public function generate($fileId)
    {
        $individualRecord = IndividualRecord::with('patient')->find($fileId);

        $user = Auth::user();

        return Inertia::render('Certificate/Generate', [
            'record' => $individualRecord,
            'user' => $user,
        ]);
    }
}
