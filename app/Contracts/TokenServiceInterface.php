<?php

namespace App\Contracts;

use App\Dto\User\TokenDto;
use App\Exceptions\TokenAccessDeniedException;
use App\Exceptions\TokenExpiredException;
use App\Models\UserToken;

interface TokenServiceInterface
{
    /**
     * @param TokenDto $dto
     * @return UserToken
     */
    public function store(TokenDto $dto): UserToken;

    /**
     * @param string $token
     * @return UserToken|null
     */
    public function findByToken(string $token): ?UserToken;

    /**
     * @param string $token
     * @return UserToken
     * @throws TokenExpiredException
     * @throws TokenAccessDeniedException
     */
    public function validate(string $token): UserToken;

    /**
     * @param UserToken $token
     * @return UserToken
     */
    public function regenerate(UserToken $token): UserToken;

    /**
     * @param UserToken $token
     * @return void
     */
    public function deactivate(UserToken $token): void;
}
