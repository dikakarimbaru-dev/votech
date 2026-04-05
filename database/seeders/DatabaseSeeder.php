<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // WAJIB ADA untuk password

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Administrator',
            'nis' => '12345',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
		    'status_pilih' => false,
        ]);

        // User Siswa untuk ngetes
        User::create([
            'name' => 'Siswa Contoh',
            'nis' => '2026001',
            'password' => Hash::make('siswa123'),
            'role' => 'voter',
		    'status_pilih' => false,
        ]);
    }
}