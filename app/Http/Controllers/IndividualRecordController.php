<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IndividualRecord;
use Inertia\Inertia;

class IndividualRecordController extends Controller
{
    const ROLES = [
        'Admin' => 1,
        'Doctor' => 2,
        'Nurse' => 3,
        'Patient' => 4,
    ];

    public function index()
    {
        $users = User::where('role', self::ROLES['Patient'])->get();

        return Inertia::render('Diagnose/Index', [
            'users' => $users,
        ]);
    }

    public function create(User $user)
    {
        $specificUser = User::find($user->id);
        return Inertia::render('Diagnose/Create', ['user' => $specificUser]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'chief_complaints' => 'required|string',
            'vital_signs' => 'nullable|string',
            'diagnosis' => 'required|string',
            'management' => 'nullable|string',
        ]);

        IndividualRecord::create($validated);

        return redirect()->route('diagnose.index')->with('success', 'Diagnostic record created successfully.');
    }
}
