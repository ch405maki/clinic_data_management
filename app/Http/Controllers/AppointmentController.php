<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Availability;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create()
    {
        // Get the ID of the currently logged-in user
        $userId = Auth::id();
        $doctors = User::where('role', 'Doctor')->select('id', 'lname', 'name')->get();
        $availability = Availability::select('date')
            ->where('date', '>=', now())
            ->groupBy('date')
            ->get();
    
        return Inertia::render('Appointment/Create', [
            'userId' => $userId,
            'doctors' => $doctors,
            'availability' => $availability,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',
        ]);

        $appointment = new Appointment();
        $appointment->patient_id = $request->patient_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->status = 'pending';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
}
