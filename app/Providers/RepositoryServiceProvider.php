<?php

namespace App\Providers;

use App\Repositories\EmployeeRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use App\Repositories\MovementRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
  # Array repositories
  protected $repositories = [
    EmployeeRepositoryInterface::class => EmployeeRepository::class,
    MovementRepositoryInterface::class => MovementRepository::class,
  ];
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    foreach ($this->repositories as $interface => $implementation) {
      $this->app->bind($interface, $implementation);
    }
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
