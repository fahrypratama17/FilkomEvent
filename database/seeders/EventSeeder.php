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
          'description' => 'Belajar desain aplikasi secara mendalam bersama mentor profesional. Materi mencakup user research, wireframing, prototyping, hingga implementasi desain menggunakan tools modern seperti Figma dan Adobe XD. Cocok untuk pemula hingga intermediate.',
          'short_description' => 'Belajar desain aplikasi dari nol sampai jadi',
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
          'image_url' => 'assets/events/Hology.png',
          'organizer' => 'BEM FILKOM',
          'contact_email' => 'bem@ub.ac.id',
          'contact_phone' => '628123456789',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'title' => 'Workshop UI/UX',
          'description' => 'Workshop ini dirancang untuk kamu yang ingin memahami dasar UI/UX secara menyeluruh. Mulai dari prinsip desain, user flow, wireframing, hingga praktik langsung menggunakan Figma. Peserta akan dibimbing step-by-step untuk membuat prototype sederhana yang siap diuji.',
          'short_description' => 'Belajar UI/UX dari dasar hingga siap praktik',
          'event_start' => Carbon::parse('2026-11-05 09:00'),
          'event_end' => Carbon::parse('2026-11-05 12:00'),
          'location' => 'Gedung Kreatif UB',
          'quota' => 50,
          'quota_filled' => 20,
          'event_status' => 'Dibuka',
          'registration_status' => 'Terdaftar',
          'price' => 50000,
          'is_paid' => true,
          'category_id' => 2,
          'created_by' => 1,
          'image_url' => 'assets/events/Talent_Tari.jpeg',
          'organizer' => 'Himpunan Mahasiswa',
          'contact_email' => 'hima@ub.ac.id',
          'contact_phone' => '628987654321',
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'title' => 'UI/UX Bootcamp: From Idea to Prototype',
          'description' => 'Bootcamp intensif ini fokus pada praktik langsung membangun produk digital. Peserta akan mengembangkan ide menjadi prototype interaktif lengkap dengan user journey, visual design, dan usability testing. Cocok untuk kamu yang ingin naik level dari sekadar teori ke implementasi nyata.',
          'short_description' => 'Bangun prototype UI/UX dari ide hingga siap presentasi',
          'event_start' => Carbon::parse('2026-11-05 13:30'),
          'event_end' => Carbon::parse('2026-11-05 17:00'),
          'location' => 'Gedung Kreatif UB',
          'quota' => 40,
          'quota_filled' => 15,
          'event_status' => 'Dibuka',
          'registration_status' => 'Terdaftar',
          'price' => 75000,
          'is_paid' => true,
          'category_id' => 3,
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
