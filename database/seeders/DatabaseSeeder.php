<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
     public function run(): void
    {
        // === Akun Admin ===
        // Akun ini memiliki peran 'admin'
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // === Akun Mentor ===
        // Akun ini memiliki peran 'mentor' dan akan dihubungkan ke tabel 'mentors'
        $mentorUser = User::create([
            'name' => 'Mentor User',
            'email' => 'mentor@example.com',
            'password' => Hash::make('password'),
            'role' => 'mentor',
        ]);

        // Buat entri di tabel 'mentors' yang terkait dengan akun ini
        Mentor::create([
            'user_id' => $mentorUser->id,
        ]);

        // === Akun Siswa ===
        // Akun ini memiliki peran 'siswa'
        User::create([
            'name' => 'Siswa User',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
    }
}
