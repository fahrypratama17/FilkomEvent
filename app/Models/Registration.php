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
}
