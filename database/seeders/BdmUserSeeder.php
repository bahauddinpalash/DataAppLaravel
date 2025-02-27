<?php

namespace Database\Seeders;
use App\Models\Bdm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BdmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bdm::create([
            'name' => 'eqa',
            'email' => 'eqa@nexroar.com',
            'password' => Hash::make('11112222'),
        ]);
    }
}
