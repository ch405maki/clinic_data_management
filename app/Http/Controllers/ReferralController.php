<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferralController extends Controller
{
    /** Show the list of users with “Refer” buttons */
    public function index()
    {
        return Inertia::render('Referrals/Index', [
            'users' => User::select('id','name','lname','email','profile_picture')->get(),
        ]);
    }

    /** Show the two‑column referral‑creation page */
    public function create(User $user)   // $user == the person being referred
    {
        return Inertia::render('Referrals/Create', [
            'referred' => $user,
            'referrer' => auth()->user(),      // current logged‑in user
        ]);
    }

    /** Persist the referral */
    public function store(Request $request)
    {
        $request->validate([
            'referred_id' => 'required|exists:users,id',
            'notes'       => 'nullable|string',
        ]);

        Referral::create([
            'referrer_id' => auth()->id(),
            'referred_id' => $request->referred_id,
            'notes'       => $request->notes,
        ]);

        return redirect()
            ->route('referrals.index')
            ->with('success', 'Referral created successfully.');
    }
}
