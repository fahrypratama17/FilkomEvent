<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'events';

  protected $primaryKey = 'event_id';

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
  ];

  protected $casts = [
    'event_start' => 'datetime',
    'event_end' => 'datetime',
    'is_paid' => 'boolean',
    'price' => 'decimal:2',
  ];

  public function category() {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
}
