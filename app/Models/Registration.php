<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
  protected $table = 'registrations';

  protected $primaryKey = 'registration_id';
  public $timestamps = false;

  protected $fillable = [
    'user_id',
    'event_id',
    'registration_status',
    'registration_date',
  ];

  protected $casts = [
    'registration_date' => 'datetime',
  ];

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function event() {
    return $this->belongsTo(Event::class, 'event_id');
  }

  public function payment() {
    return $this->hasOne(Payment::class, 'registration_id');
  }

  public function certificate() {
    return $this->hasOne(Certificate::class, 'registration_id');
  }
}
