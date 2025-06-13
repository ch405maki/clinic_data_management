<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferralController extends Controller
{
    /** Show the list of users with “Refer” buttons */
    // app/Http/Controllers/ReferralController.php

    public function index()
    {
        $users = User::select('id', 'name', 'lname', 'email', 'profile_picture')
            ->withCount([
                // each COUNT(*) where this user is the *referred* person
                'referralsReceived as referral_count'
            ])
            ->get();

        return Inertia::render('Referrals/Index', [
            'users' => $users,
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

    public function list()
    {
        $referrals = Referral::with(['referred:id,name,lname,email,profile_picture'])
            ->where('referrer_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Referrals/List', [
            'referrals' => $referrals,
        ]);
    }

    /** Show a single referral */
    public function show(Referral $referral)
    {
        // Optional: make sure the viewer is the owner
        // if ($referral->referrer_id !== auth()->id()) abort(403);

        return Inertia::render('Referrals/Show', [
            'referral' => $referral->load(['referred', 'referrer']),
        ]);
    }

    public function userReferrals(User $user)
    {
        $referrals = Referral::with('referrer:id,name,lname,email')
            ->where('referred_id', $user->id)
            ->latest()
            ->get();

        return Inertia::render('Referrals/UserList', [
            'referred'  => $user,       // the person being viewed
            'referrals' => $referrals,  // all referrals about them
        ]);
    }
}
