<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada (opsional)
        // DB::table('users')->where('email', 'admin@gmail.com')->delete();

        // Gunakan updateOrCreate untuk menghindari duplicate
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('kenaya27'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('kenaya27'),
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'userkevin@gmail.com'],
            [
                'name' => 'User Kevin',
                'password' => Hash::make('kenaya27'),
                'role' => 'user',
            ]
        );

        $this->command->info('Admin users seeded successfully!');
    }
}