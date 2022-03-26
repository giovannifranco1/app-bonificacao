<?php

namespace App\Repositories\Abstract;

use App\Repositories\Interfaces\BaseEloquentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEloquentRepository implements BaseEloquentInterface
{
  protected $model;
  protected $instance;

  private $orderDirection = 'asc';

  public function all($orderBy = 'id', array $relations = []): Collection
  {
    $instance = $this->getNewInstance();

    return $instance->with($relations)
      ->orderBy($orderBy, $this->orderDirection)
      ->get();
  }

  public function findBy($field, $value, array $relations = []): Model
  {
    $this->instance = $this->getNewInstance()
      ->newQuery()
      ->with($relations)
      ->where($field, $value)
      ->first();

    return $this->instance;
  }

  protected function applyFilters(array $parameters)
  {
    return function ($query) use ($parameters) {
      foreach ($parameters as $field => $value) {
        $query->where($field, $value);
      }
    };
  }

  public function paginate(int $paginate = 25, $orderBy = 'full_name', array $relations = [], $parameters = [])
  {
    $this->instance = $this->getNewInstance()->newQuery();

    $callbak_parameters = function ($query) use ($parameters) {
      foreach ($parameters as $field => $value) {
        $query->where($field, $value);
      }
    };

    return $this->instance->with($relations)
      ->orderBy($orderBy, $this->orderDirection)
      ->where($callbak_parameters)
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

  private function getNewInstance()
  {
    return new $this->model;
  }
}
