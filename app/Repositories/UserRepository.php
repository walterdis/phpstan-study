<?php

namespace App\Repositories;

use App\Models\User;
use App\QueryBuilders\UserQueryBuilder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends AbstractRepository<User, UserQueryBuilder>
 */
class UserRepository extends AbstractRepository
{
    public function __construct(
        protected readonly User $model,
    ) {
    }

    public function getModel(): User
    {
        return $this->model;
    }

    public function teste(): void
    {
        $a = $this->all();

        $a->get(0)->getName();
    }

    /**
     * @return Collection<int, User>
     */
    public function teste2(): Collection
    {
        return $this->query()->byName('teste')->get();
    }
}
