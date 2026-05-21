<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return User::query();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): User
    {
        return $this->query()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?User
    {
        return $this->query()->find($id);
    }
}
