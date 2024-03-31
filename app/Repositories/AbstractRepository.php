<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Scope;

/**
 * @template  TModel
 * @template TBuilder
 */
abstract class AbstractRepository
{
    /**
     * @var array<string, Scope>
     */
    private array $scopes = [];

    /**
     * @return TModel
     */
    abstract public function getModel();

    /**
     * @return TBuilder
     */
    public function query()
    {
        $query = $this->getModel()::query();

        return $query;
    }

    /**
     * @return Collection<array-key, TModel>
     */
    public function all(): Collection
    {
        return $this->query()->get();
    }

    public function addScope(Scope $scope): void
    {
        $this->scopes[get_class($scope)] = $scope;
    }

    /**
     * @phpstan-param  TModel $model
     *
     * @phpstan-return TBuilder
     */
    private function applyScopes($model)
    {
        foreach ($this->scopes as $key => $scope) {
            $model = $model->withGlobalScope($key, $scope);
        }

        return $model;
    }
}
