<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('events')->insert([
        [
          'title' => 'Desain Aplikasi',
          'description' => 'Belajar desain aplikasi bersama mentor profesional',
          'event_start' => Carbon::parse('2026-11-01 13:00'),
          'event_end' => Carbon::parse('2026-11-01 17:00'),
          'location' => 'FILKOM UB',
          'quota' => 100,
          'quota_filled' => 80,
          'event_status' => 'Dibuka',
          'registration_status' => 'Terdaftar',
          'price' => 0,
          'is_paid' => false,
          'category_id' => 1,
          'created_by' => 1,
          'image_url' => 'assets/events/Hology.jpeg',
          'organizer' => 'BEM FILKOM',
          'contact_email' => 'bem@ub.ac.id',
          'contact_phone' => '628123456789',
          'created_at' => now(),
        ],
        [
          'title' => 'Workshop UI/UX',
          'description' => 'Mendalami UI/UX dari dasar hingga mahir',
          'event_start' => Carbon::parse('2026-11-05 09:00'),
          'event_end' => Carbon::parse('2026-11-05 12:00'),
          'location' => 'Gedung Kreatif UB',
          'quota' => 50,
          'quota_filled' => 20,
          'event_status' => 'Dibuka',
          'registration_status' => 'Terdaftar',
          'price' => 50000,
          'is_paid' => true,
          'category_id' => 1,
          'created_by' => 1,
          'image_url' => 'assets/events/Talent_Tari.jpeg',
          'organizer' => 'Himpunan Mahasiswa',
          'contact_email' => 'hima@ub.ac.id',
          'contact_phone' => '628987654321',
          'created_at' => now(),
        ],
        [
          'title' => 'Workshop UI/UX',
          'description' => 'Mendalami UI/UX dari dasar hingga mahir',
          'event_start' => Carbon::parse('2026-11-05 09:00'),
          'event_end' => Carbon::parse('2026-11-05 12:00'),
          'location' => 'Gedung Kreatif UB',
          'quota' => 50,
          'quota_filled' => 20,
          'event_status' => 'Dibuka',
          'registration_status' => 'Terdaftar',
          'price' => 50000,
          'is_paid' => true,
          'category_id' => 1,
          'created_by' => 1,
          'image_url' => 'assets/events/UABT.jpeg',
          'organizer' => 'Himpunan Mahasiswa',
          'contact_email' => 'hima@ub.ac.id',
          'contact_phone' => '628987654321',
          'created_at' => now(),
          'updated_at' => now(),
        ],
      ]);
    }
}
