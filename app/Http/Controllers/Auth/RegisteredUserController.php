<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
