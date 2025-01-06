<?php

// app/Models/IndividualRecord.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}