<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
  public function run(): void
  {
    $filePath = 'icon/testimonials_1.svg';

    Registration::query()->orderBy('registration_id')->get()->each(function (Registration $registration) use ($filePath) {
      Certificate::firstOrCreate(
        ['registration_id' => $registration->registration_id],
        [
          'file_path' => $filePath,
          'date_generate' => now(),
        ]
      );
    });
  }
}

