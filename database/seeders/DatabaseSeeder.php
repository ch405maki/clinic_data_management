<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        // Doctor
        User::create([
            'name' => 'Doctor User',
            'email' => 'doctor@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Doctor',
        ]);

        // Nurse
        User::create([
            'name' => 'Nurse User',
            'email' => 'nurse@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Nurse',
        ]);

        // Patient
        User::create([
            'name' => 'Patient User',
            'email' => 'patient@mail.com',
            'contact_no' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'Patient',
        ]);
    }
}
