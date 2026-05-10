<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGoal extends Model
{
  protected $table = 'event_goals';
  protected $primaryKey = 'goal_id';
  public $timestamps = false;

  protected $fillable = [
    'event_id',
    'description',
  ];

  public function event()
  {
    return $this->belongsTo(Event::class, 'event_id');
  }
}
