<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
  protected $table = 'movement';
  protected $fillable = [
    'movement_type',
    'value',
    'note',
  ];

  use HasFactory;
}
