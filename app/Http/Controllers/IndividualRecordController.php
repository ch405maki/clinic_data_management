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
        $individualRecords = IndividualRecord::pendingWithPatients()->get();

        return Inertia::render('Diagnose/Index', [
            'individualRecords' => $individualRecords,
        ]);
    }
    

    public function vitalIndex()
    {
        $users = User::where('role', self::ROLES['Patient'])->get();

        return Inertia::render('Vital/Index', [
            'users' => $users,
        ]);
    }

    public function create(User $user)
    {
        $specificUser = User::find($user->id);
        return Inertia::render('Diagnose/Create', ['user' => $specificUser]);
    }

    public function vitalsCreate(User $user)
    {
        $specificUser = User::find($user->id);
        return Inertia::render('Vital/Vital', ['user' => $specificUser]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'chief_complaints' => 'nullable|string',
            'vital_signs' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'management' => 'nullable|string',
        ]);

        IndividualRecord::create($validated);

        return redirect()->route('diagnose.index')->with('success', 'Diagnostic record created successfully.');
    }

    public function store_vital(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'chief_complaints' => 'nullable|string',
            'vital_signs' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'management' => 'nullable|string',
        ]);

        IndividualRecord::create($validated);

        return redirect()->route('vital.index')->with('success', 'Diagnostic record created successfully.');
    }

    public function edit($id)
    {
        $record = IndividualRecord::with('patient')->findOrFail($id);
    
        return Inertia::render('Diagnose/Edit', [
            'record' => $record,
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'chief_complaints' => 'required|string|max:255',
            'vital_signs' => 'nullable|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'management' => 'nullable|string|max:255',
        ]);

        // Add a predefined status of "Completed"
        $validated['status'] = 'completed';

        $diagnostic = IndividualRecord::findOrFail($id);
        $diagnostic->update($validated);

        return redirect()->route('diagnose.index')->with('success', 'Diagnostic record updated successfully!');
    }

}
