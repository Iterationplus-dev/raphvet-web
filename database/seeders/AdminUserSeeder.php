<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@raphvet.com'],
            [
                'name' => 'Raph Admin',
                'password' => Hash::make('admin123456'),
                'phone' => '+2348000000000',
                'is_active' => true,
            ],
        );

        $admin->assignRole('admin');
    }
}
