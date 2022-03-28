<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $guard = 'administrator';
  protected $table = 'administrator';

  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $fillable = [
    'full_name',
    'login',
    'password',
  ];
}
