<?php

namespace App\Contracts;

use App\Dto\User\TokenDto;
use App\Exceptions\TokenAccessDeniedException;
use App\Exceptions\TokenExpiredException;
use App\Models\UserToken;

interface TokenServiceInterface
{
    public function store(TokenDto $dto): UserToken;

    public function findByToken(string $token): ?UserToken;

    /**
     * @throws TokenExpiredException
     * @throws TokenAccessDeniedException
     */
    public function validate(string $token): UserToken;

    public function regenerate(UserToken $token): UserToken;

    public function deactivate(UserToken $token): void;
}
