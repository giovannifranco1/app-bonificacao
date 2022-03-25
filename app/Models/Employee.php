<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $table = 'Employee';
  protected $fillable = [
    'full_name',
    'login',
    'password',
    'current_balance',
    'administrator_id',
  ];

  use HasFactory;
}
