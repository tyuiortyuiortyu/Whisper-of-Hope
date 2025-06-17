<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'whisperofhope@gmail.com'],
            [
                'name' => 'Whisper of Hope',
                'email' => 'whisperofhope@gmail.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'gender' => 'female',
                'phone' => '08xxxxxxxxx',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@whisperofhope.com'],
            [
                'name' => 'Admin Whisper of Hope',
                'email' => 'admin@whisperofhope.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'gender' => 'female',
                'phone' => '08123456789',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'superadmin@whisperofhope.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@whisperofhope.com',
                'password' => Hash::make('superadmin123'),
                'role' => 'admin',
                'gender' => 'male',
                'phone' => '08987654321',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: whisperofhope@gmail.com | Password: Admin123');
        $this->command->info('Email: admin@whisperofhope.com | Password: admin123');
        $this->command->info('Email: superadmin@whisperofhope.com | Password: superadmin123');
    }
}
