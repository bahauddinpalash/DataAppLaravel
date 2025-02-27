<?php

namespace Database\Seeders;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecruiterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recruiter::create([
            'name' => 'kogi',
            'email' => 'kogi@nexroar.com',
            'password' => Hash::make('11112222'),
        ]);
    }
}
