<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    const ROLES = [
        'Admin' => 1,
        'Doctor' => 2,
        'Nurse' => 3,
        'Patient' => 4,
    ];


    public function admin()
    {
        $users = User::where('role', self::ROLES['Admin'])->get();
    
        return Inertia::render('UserManagement/Admin', [
            'users' => $users,
        ]);
    }

    public function doctor()
    {
        $users = User::where('role', self::ROLES['Doctor'])->get();

        return Inertia::render('UserManagement/Doctor', [
            'users' => $users,
        ]);
    }

    public function nurse()
    {
        $users = User::where('role', self::ROLES['Nurse'])->get();

        return Inertia::render('UserManagement/Nurse', [
            'users' => $users,
        ]);
    }

    public function patient()
    {
        $users = User::where('role', self::ROLES['Patient'])->get();

        return Inertia::render('UserManagement/Patient', [
            'users' => $users,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string',
            'course_year' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|in:Male,Female',
            'position' => 'nullable|string',
            'civil_status' => 'nullable|string|in:Single,Married,Divorced',
            'address' => 'nullable|string',
            'contact_no' => 'nullable|string',
            'emergency_name' => 'nullable|string',
            'emergency_relationship' => 'nullable|string',
            'emergency_address' => 'nullable|string',
            'emergency_contact_no' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'course_year' => $request->course_year,
            'date_of_birth' => $request->date_of_birth,
            'age' => $request->age,
            'gender' => $request->gender,
            'position' => $request->position,
            'civil_status' => $request->civil_status,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'emergency_name' => $request->emergency_name,
            'emergency_relationship' => $request->emergency_relationship,
            'emergency_address' => $request->emergency_address,
            'emergency_contact_no' => $request->emergency_contact_no,
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User created successfully.');
    }
}