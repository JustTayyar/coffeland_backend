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
        // Kofeşop sahibinin ilkin admin hesabı
        User::updateOrCreate(
            ['email' => 'admin@domain.com'], // Əgər bu email varsa yaratmayacaq, yeniləyəcək
            [
                'name' => 'Kofeshop Sahibi',
                'firstname' => 'Kofeshop',
                'lastname' => 'Sahibi',
                'password' => Hash::make('admin123'), // Sahib bu şifrə ilə sistemə daxil olub sonra dəyişəcək
                'role' => 'admin',
            ]
        );
    }
}
