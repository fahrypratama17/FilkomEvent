<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use Carbon\Carbon;

class ActivityLogSeeder extends Seeder
{
  public function run(): void
  {
    $activities = [
      [
        'user_id' => 1,
        'action' => 'login',
        'description' => 'User login ke sistem',
        'created_at' => Carbon::now()->subHours(5),
      ],
      [
        'user_id' => 1,
        'action' => 'register_event',
        'description' => 'User mendaftar pada event Web Development Bootcamp',
        'created_at' => Carbon::now()->subHours(4),
      ],
      [
        'user_id' => 1,
        'action' => 'payment',
        'description' => 'User melakukan pembayaran untuk event',
        'created_at' => Carbon::now()->subHours(3),
      ],
      [
        'user_id' => 2,
        'action' => 'login',
        'description' => 'User login ke sistem',
        'created_at' => Carbon::now()->subHours(2),
      ],
      [
        'user_id' => 2,
        'action' => 'bookmark_event',
        'description' => 'User membookmark event AI Workshop',
        'created_at' => Carbon::now()->subHours(1),
      ],
    ];

    foreach ($activities as $activity) {
      ActivityLog::create($activity);
    }
  }
}
