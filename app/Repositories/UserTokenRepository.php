<?php

namespace App\Repositories;

use App\Contracts\UserTokenRepositoryInterface;
use App\Enums\TokenStatus;
use App\Models\UserToken;
use Illuminate\Database\Eloquent\Builder;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return UserToken::query();
    }

    /**
     * @param array $data
     * @return UserToken
     */
    public function create(array $data): UserToken
    {
        return $this->query()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function findByToken(string $token): ?UserToken
    {
        return $this->query()->where('token', $token)->first();
    }

    /**
     * @inheritDoc
     */
    public function delete(UserToken $token): void
    {
        $token->delete();
    }

    /**
     * @inheritDoc
     */
    public function setStatus(UserToken $token, TokenStatus $status): void
    {
        $token->update(['status' => $status]);
    }
}
