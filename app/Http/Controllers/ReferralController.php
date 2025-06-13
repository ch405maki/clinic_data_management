<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferralController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Referrals/Index', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'referrer_id' => 'required|exists:users,id',
            'referred_id' => 'required|exists:users,id|different:referrer_id',
            'notes' => 'nullable|string',
        ]);

        Referral::create($request->only('referrer_id', 'referred_id', 'notes'));

        return redirect()->back()->with('success', 'Referral created.');
    }
}
