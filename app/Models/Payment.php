<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $table = 'payments';

  protected $primaryKey = 'payment_id';

  public $timestamps = false;

  protected $fillable = [
    'registration_id',
    'invoice_code',
    'method',
    'amount',
    'status',
    'transaction_id',
    'created_at',
  ];

  public function registration() {
    return $this->belongsTo(Registration::class, 'registration_id');
  }
}
