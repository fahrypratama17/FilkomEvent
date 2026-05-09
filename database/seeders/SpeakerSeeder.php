<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Speaker;

class SpeakerSeeder extends Seeder
{
  public function run(): void
  {
    $speakers = [
      [
        'name' => 'Prof. Dr. Budi Santoso',
        'title' => 'Professor of Computer Science',
        'organization' => 'Universitas Brawijaya',
        'photo_url' => 'assets/profile/boy.png',
      ],
      [
        'name' => 'Ir. Siti Nurhaliza, S.Kom, M.T',
        'title' => 'Senior Software Engineer',
        'organization' => 'PT. Indonesia Tech Solutions',
        'photo_url' => 'assets/profile/girl.png',
      ],
      [
        'name' => 'Drs. Ahmad Wijaya',
        'title' => 'Digital Marketing Specialist',
        'organization' => 'Digital Marketing Institute',
        'photo_url' => 'assets/profile/boy.png',
      ],
      [
        'name' => 'Dr. Eka Prasetya',
        'title' => 'Cybersecurity Expert',
        'organization' => 'Cyber Security Association',
        'photo_url' => 'assets/profile/boy.png',
      ],
      [
        'name' => 'Rini Handayani, S.T, M.Kom',
        'title' => 'Mobile Development Lead',
        'organization' => 'Startup Innovation Hub',
        'photo_url' => 'assets/profile/girl.png',
      ],
    ];

    foreach ($speakers as $speaker) {
      Speaker::create($speaker);
    }
  }
}
