<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      UserSeeder::class,
      AdminSeeder::class,
      CategorySeeder::class,
      EventSeeder::class,
      SpeakerSeeder::class,
      EventSpeakerSeeder::class,
      EventGoalSeeder::class,
      RegistrationSeeder::class,
      CertificateSeeder::class,
      ActivityLogSeeder::class,
    ]);
  }
}
