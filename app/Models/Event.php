<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'events';
  protected $primaryKey = 'event_id';
  public $timestamps = false;

  protected $casts = [
    'event_start' => 'datetime',
    'event_end' => 'datetime',
    'created_at' => 'datetime',
  ];

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

  public function bookmarkedBy()
  {

    return $this->belongsToMany(
      \App\Models\User::class,
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

  public function getStatusLabelAttribute(): string
  {
    return match ($this->event_status) {
      'Aktif' => 'Aktif',
      'Akan Datang' => 'Akan Datang',
      'Berlangsung' => 'Berlangsung',
      'Selesai' => 'Selesai',
      'Dibatalkan' => 'Dibatalkan',
      default => ucfirst(str_replace('_', ' ', $this->event_status)),
    };
  }

  public function getStatusClassAttribute(): string
  {
    return match ($this->event_status) {
      'Aktif', 'Akan Datang' => 'bg-[#1F388B]',
      'Berlangsung', 'Selesai' => 'bg-[#16A34A]',
      'Dibatalkan' => 'bg-[#E13427]',
      default => 'bg-gray-400',
    };
  }

  public function getFormattedStartDateAttribute(): string
  {
    if (!$this->event_start) {
      return '-';
    }

    return \Carbon\Carbon::parse($this->event_start)
      ->format('d M Y');
  }

  public function getFormattedTimeAttribute(): string
  {
    if (!$this->event_start || !$this->event_end) {
      return '-';
    }

    $start = \Carbon\Carbon::parse($this->event_start);
    $end = \Carbon\Carbon::parse($this->event_end);

    return $start->format('H:i') . ' - ' . $end->format('H:i');
  }

  public function getQuotaTextAttribute(): string
  {
    $filled = $this->quota_filled ?? 0;
    $total = $this->quota ?? 0;

    return "{$filled}/{$total}";
  }

  public function getPriceTextAttribute(): string
  {
    if (!$this->is_paid) {
      return 'Gratis';
    }

    return 'Rp' . number_format((float) $this->price, 0, ',', '.');
  }
}
