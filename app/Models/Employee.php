<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  use HasFactory;

  protected $table = 'Employee';
  protected $fillable = [
    'full_name',
    'login',
    'password',
    'current_balance',
    'administrator_id',
  ];

  public function administrator()
  {
    return $this->belongsTo(Administrator::class, 'administrator_id', 'id');
  }
}
