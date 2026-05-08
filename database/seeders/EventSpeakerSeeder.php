<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSpeakerSeeder extends Seeder
{
  public function run(): void
  {
    $eventSpeakers = [
      ['event_id' => 1, 'speaker_id' => 1],
      ['event_id' => 1, 'speaker_id' => 2],

      ['event_id' => 2, 'speaker_id' => 3],
      ['event_id' => 2, 'speaker_id' => 4],

      ['event_id' => 3, 'speaker_id' => 4],
      ['event_id' => 3, 'speaker_id' => 5],

      ['event_id' => 4, 'speaker_id' => 1],
      ['event_id' => 4, 'speaker_id' => 3],
      ['event_id' => 4, 'speaker_id' => 5],

      ['event_id' => 5, 'speaker_id' => 2],
      ['event_id' => 5, 'speaker_id' => 4],

      ['event_id' => 6, 'speaker_id' => 1],
      ['event_id' => 6, 'speaker_id' => 2],
      ['event_id' => 6, 'speaker_id' => 3],

      ['event_id' => 7, 'speaker_id' => 1],
      ['event_id' => 7, 'speaker_id' => 5],

      ['event_id' => 8, 'speaker_id' => 2],
    ];

    foreach ($eventSpeakers as $eventSpeaker) {
      DB::table('event_speakers')->insert([
        'event_id' => $eventSpeaker['event_id'],
        'speaker_id' => $eventSpeaker['speaker_id'],
      ]);
    }
  }
}
