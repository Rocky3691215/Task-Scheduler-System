<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@example.com';

        $admin = User::where('email', $email)->first();

        if (!$admin) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin',
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    }
}
