<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use inertia\Inertia;
use App\Models\User; 
use App\Models\IndividualRecord; 

class DashboardController extends Controller
{
    public function index()
    {
        $doctorCount = User::where('role', 'Doctor')->count();
        $patientCount = User::where('role', 'Patient')->count();
        $nurseCount = User::where('role', 'Nurse')->count();
        $recentPatients = User::where('role', 'Patient')
        ->where('status', 'active')
        ->latest()
        ->take(5)
        ->get();
        $individualRecordCount = IndividualRecord::count();
        $currentUserRole = auth()->user()->role;
        $users = User::where('status','pending')->get();

        if ($currentUserRole === 'Patient') {
            $records = IndividualRecord::where('patient_id', auth()->id())->get();
            $user = auth()->user();

            return Inertia::render('UserDashboard/Index', [
                'records' => $records,
                'user' => $user,
                'userRole' => $currentUserRole,
            ]);
        }

        return Inertia::render('Dashboard', [
            'doctorCount' => $doctorCount,
            'patientCount' => $patientCount,
            'nurseCount' => $nurseCount,
            'recentPatients' => $recentPatients,
            'individualRecordCount' => $individualRecordCount,
            'currentUserRole' => $currentUserRole,
            'users' => $users,
        ]);
    }
}
