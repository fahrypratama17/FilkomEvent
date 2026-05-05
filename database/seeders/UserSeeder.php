<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('users')->insert([
        [
          'name' => 'Aniza Helwa',
          'nim' => '245150207111049',
          'email' => 'helwa@student.ub.ac.id',
          'password' => Hash::make('1234567890'),
          'role' => 'Mahasiswa',
          'created_at' => now(),
        ],
        [
          'name' => 'Aditya Akbar',
          'nim' => '2451501111028',
          'email' => 'adityaakbar@student.ub.ac.id',
          'password' => Hash::make('admin123'),
          'role' => 'Admin',
          'created_at' => now(),
        ],
      ]);
    }
}
