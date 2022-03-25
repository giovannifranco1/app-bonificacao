<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
  protected $table = 'Administrator';
  protected $fillable = [
    'full_name',
    'login',
    'password',
  ];

  use HasFactory;
}
