<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class IndividualRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'chief_complaints',
        'vital_signs',
        'diagnosis',
        'management',
        'status',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function scopeFilterByRole($query)
    {
        if (Auth::user()->role !== 'Patient') {
            return $query;
        }

        return $query->where('patient_id', Auth::id());
    }

    public function scopePendingWithPatients($query)
    {
        return $query->where('status', 'pending')->with('patient');
    }
}