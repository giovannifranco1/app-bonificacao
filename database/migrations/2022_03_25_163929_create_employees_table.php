<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('employee', function (Blueprint $table) {
      # Primary key
      $table->id();
      $table->string('full_name');
      $table->string('login')->unique();
      $table->string('password');
      $table->decimal('current_balance')->default(0.0);

      # Foreign key
      $table->foreignId('administrator_id')->constrained('administrator');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('employee');
  }
};
