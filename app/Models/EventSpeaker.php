<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSpeaker extends Model
{
  protected $table = 'event_speakers';
  protected $primaryKey = 'id';
  public $timestamps = false;

  protected $fillable = [
    'event_id',
    'speaker_id',
  ];

  public function event()
  {
    return $this->belongsTo(Event::class, 'event_id');
  }

  public function speaker()
  {
    return $this->belongsTo(Speaker::class, 'speaker_id');
  }
}
