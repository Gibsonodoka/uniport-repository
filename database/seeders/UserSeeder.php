<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@uniport.edu.ng'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin123!'),
                'email_verified_at' => now(),
            ]
        );

        // Regular User 1
        User::updateOrCreate(
            ['email' => 'john.doe@student.uniport.edu.ng'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('Password123!'),
                'email_verified_at' => now(),
            ]
        );

        // Regular User 2
        User::updateOrCreate(
            ['email' => 'mary.james@student.uniport.edu.ng'],
            [
                'name' => 'Mary James',
                'password' => Hash::make('Password123!'),
                'email_verified_at' => now(),
            ]
        );
    }
}
