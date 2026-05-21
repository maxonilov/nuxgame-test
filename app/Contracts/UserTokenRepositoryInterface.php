<?php

namespace App\Contracts;

use App\Enums\TokenStatus;
use App\Models\UserToken;

interface UserTokenRepositoryInterface
{
    /**
     * @param array $data
     * @return UserToken
     */
    public function create(array $data): UserToken;

    /**
     * @param string $token
     * @return UserToken|null
     */
    public function findByToken(string $token): ?UserToken;

    /**
     * @param UserToken $token
     * @return void
     */
    public function delete(UserToken $token): void;

    /**
     * @param UserToken $token
     * @param TokenStatus $status
     * @return void
     */
    public function setStatus(UserToken $token, TokenStatus $status): void;
}
