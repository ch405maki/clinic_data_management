<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class DoctorAvailabilityController extends Controller
{
    public function index()
    {
        // Fetch all doctors with role 'Doctor'
        $doctors = User::where('role', 'Doctor')->select('id', 'lname', 'name')->get();

        // Fetch all availability records with associated doctor
        $availability = Availability::with('doctor:id,lname,name')->get();

        return Inertia::render('Availability/Index', [
            'doctors' => $doctors,
            'availability' => $availability,
        ]);
    }

    /**
     * Store availability.
     */
    public function store(Request $request)
    {
        // Validate request input
        $request->validate([
            'doctor_id' => 'required|exists:users,id', // Ensure doctor_id exists in the users table
            'date' => 'required|date|after_or_equal:today', // Ensure date is today or future
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Create a new availability record
        Availability::create([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Availability saved successfully.');
    }


    
    public function destroy($id)
    {
        $availability = Availability::findOrFail($id);
        $availability->delete();

        return redirect()->back()->with('success', 'Availability deleted successfully.');
    }

}
