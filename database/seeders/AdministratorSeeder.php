<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    # Collection of adminstrators
    $administrators = collect([
      [
        'full_name' => 'admin',
        'login' => 'admin',
        'password' => 'admin',
      ],
      [
        'full_name' => 'Giovanni',
        'login' => 'giovanni',
        'password' => '123',
      ],
    ]);

    # Insert
    foreach ($administrators as $value) {
      Administrator::create([
        'full_name' => $value['full_name'],
        'login' => $value['login'],
        'password' => bcrypt($value['password']),
      ]);
    }
  }
}
