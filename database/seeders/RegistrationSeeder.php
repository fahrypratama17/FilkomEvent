<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('registrations')->insert([
        // user_id = 1 (user login kamu)

        ['user_id' => 1, 'event_id' => 1, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
        ['user_id' => 1, 'event_id' => 1, 'registration_status' => 'Terdaftar', 'registration_date' => now()],

        ['user_id' => 1, 'event_id' => 2, 'registration_status' => 'Terdaftar', 'registration_date' => now()],

        ['user_id' => 1, 'event_id' => 3, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
        ['user_id' => 1, 'event_id' => 3, 'registration_status' => 'Terdaftar', 'registration_date' => now()],
      ]);
    }
}
