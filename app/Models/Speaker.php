<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
  protected $table = 'speakers';
  protected $primaryKey = 'speaker_id';
  public $timestamps = false;

  protected $fillable = [
    'name',
    'title',
    'organization',
    'photo_url',
  ];

  public function events()
  {
    return $this->belongsToMany(
      Event::class,
      'event_speakers',
      'speaker_id',
      'event_id'
    );
  }
}
