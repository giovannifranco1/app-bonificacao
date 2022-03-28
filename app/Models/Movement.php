<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Movement extends Model
{
  use HasFactory;

  protected $table = 'movement';
  protected $fillable = [
    'movement_type',
    'value',
    'note',
    'employee_id',
    'administrator_id',
  ];

  public static function typesMovement(): Collection
  {
    return collect([
      'income' => 'Income',
      'expense' => 'Expense',
    ]);
  }
  public function employee()
  {
    return $this->belongsTo(Employee::class, 'employee_id', 'id');
  }
}
