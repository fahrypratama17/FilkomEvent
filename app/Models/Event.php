<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'events';
  protected $primaryKey = 'event_id';
  public $timestamps = false;

  protected $fillable = [
    'title',
    'description',
    'short_description',
    'event_start',
    'event_end',
    'location',
    'quota',
    'quota_filled',
    'event_status',
    'registration_status',
    'price',
    'is_paid',
    'category_id',
    'created_by',
    'image_url',
    'organizer',
    'contact_email',
    'contact_phone',
    'created_at',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }

  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function registrations()
  {
    return $this->hasMany(Registration::class, 'event_id');
  }

  public function bookmarks()
  {
    return $this->belongsToMany(
      User::class,
      'bookmarks',
      'event_id',
      'user_id'
    );
  }

  public function speakers()
  {
    return $this->belongsToMany(
      Speaker::class,
      'event_speakers',
      'event_id',
      'speaker_id'
    );
  }

  public function goals()
  {
    return $this->hasMany(EventGoal::class, 'event_id');
  }
}
