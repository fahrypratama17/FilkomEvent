<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';
  protected $primaryKey = 'category_id';

  protected $fillable = [
    'category_name'
  ];

  public function events() {
    return $this->hasMany(Event::class, 'category_id', 'category_id');
  }
}
