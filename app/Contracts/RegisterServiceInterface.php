<?php

namespace App\Contracts;

use App\Dto\User\RegisterDto;
use App\Models\UserToken;

interface RegisterServiceInterface
{
    /**
     * @param RegisterDto $dto
     * @return UserToken
     */
    public function make(RegisterDto $dto): UserToken;

    /**
     * @param UserToken $token
     * @return void
     */
    public function deactivate(UserToken $token): void;
}
