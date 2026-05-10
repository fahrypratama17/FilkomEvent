<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
  protected $table = 'certificates';

  protected $primaryKey = 'certificate_id';

  public $timestamps = false;

  protected $fillable = [
    'registration_id',
    'file_path',
    'date_generate',
  ];

  public function registration() {
    return $this->belongsTo(Registration::class, 'registration_id');
  }
}
