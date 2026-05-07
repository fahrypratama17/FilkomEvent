<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventGoal;

class EventGoalSeeder extends Seeder
{
  public function run(): void
  {
    $goals = [
      [
        'event_id' => 1,
        'description' => 'Memahami konsep dasar web development',
      ],
      [
        'event_id' => 1,
        'description' => 'Menguasai HTML, CSS, dan JavaScript',
      ],
      [
        'event_id' => 1,
        'description' => 'Membuat website responsif dan modern',
      ],
      [
        'event_id' => 2,
        'description' => 'Memahami prinsip machine learning',
      ],
      [
        'event_id' => 2,
        'description' => 'Implementasi AI dalam proyek nyata',
      ],
      [
        'event_id' => 3,
        'description' => 'Meningkatkan skill public speaking',
      ],
      [
        'event_id' => 3,
        'description' => 'Strategi presentasi yang efektif',
      ],
    ];

    foreach ($goals as $goal) {
      EventGoal::create($goal);
    }
  }
}
