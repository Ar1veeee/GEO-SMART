<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin GIS',
            'email' => 'gis@admin.com',
            'password' => Hash::make('Admin123'),
        ]);
    }
}
