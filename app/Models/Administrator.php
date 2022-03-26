<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Administrator extends User
{
  use HasFactory, Notifiable;

  protected $table = 'administrator';
  protected $fillable = [
    'full_name',
    'login',
    'password',
  ];

}
