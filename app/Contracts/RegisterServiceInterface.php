<?php

namespace App\Contracts;

use App\Dto\User\RegisterDto;
use App\Models\UserToken;

interface RegisterServiceInterface
{
    public function make(RegisterDto $dto): UserToken;

    public function deactivate(UserToken $token): void;
}
