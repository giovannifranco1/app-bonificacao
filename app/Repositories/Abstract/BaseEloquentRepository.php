<?php

namespace App\Repositories\Abstract;

use App\Repositories\Interfaces\Abstract\BaseEloquentRepositoryInterface;

abstract class BaseEloquentRepository implements BaseEloquentRepositoryInterface
{
  protected $model;
  protected $instance;
  private $orderDirection = 'asc';

  public function all($orderBy = 'id', array $relations = [])
  {
    $instance = $this->getNewInstance();

    return $instance->with($relations)
      ->orderBy($orderBy, $this->orderDirection)
      ->get();
  }

  public function paginate($orderBy = 'full_name', array $relations = [], $paginate = 25)
  {
    $instance = $this->getNewInstance();

    return $instance->with($relations)
      ->orderBy($orderBy, $this->orderDirection)
      ->paginate($paginate);
  }

  protected function executeSave(array $data)
  {
    $this->instance->fill($data);
    $this->instance->save();

    return $this->instance;
  }

  public function store(array $data)
  {
    $this->instance = $this->getNewInstance();

    return $this->executeSave($data);
  }

  public function find($id, array $relations = [])
  {
    $this->instance = $this->getNewInstance()
      ->with($relations)
      ->find($id);

    return $this->instance;
  }

  public function update($id, array $data)
  {
    $this->instance = $this->find($id);

    return $this->executeSave($data);
  }

  public function getNewInstance()
  {
    return new $this->model;
  }
}
