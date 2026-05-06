<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $userId = DB::table('users')
        ->where('role', 'Mahasiswa')
        ->value('user_id');

      if (! $userId) {
        $userId = DB::table('users')->insertGetId([
          'name' => 'Demo Mahasiswa',
          'nim' => '235150700000001',
          'email' => 'demo@student.ub.ac.id',
          'password' => Hash::make('password123'),
          'role' => 'Mahasiswa',
          'created_at' => now(),
        ]);
      }

      DB::table('registrations')->insert([
        // Demo registrations for the first available Mahasiswa account.

        ['user_id' => $userId, 'event_id' => 1, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
        ['user_id' => $userId, 'event_id' => 1, 'registration_status' => 'Terdaftar', 'registration_date' => now()],

        ['user_id' => $userId, 'event_id' => 2, 'registration_status' => 'Terdaftar', 'registration_date' => now()],

        ['user_id' => $userId, 'event_id' => 3, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
        ['user_id' => $userId, 'event_id' => 3, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
      ]);
    }
}
