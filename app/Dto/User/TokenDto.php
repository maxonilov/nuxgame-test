<?php

namespace App\Dto\User;

class TokenDto
{
    /**
     * @var string|null
     */
    public ?string $token;

    /**
     * @param int $userId
     */
    public function __construct(public int $userId)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'token'    => $this->token,
        ];
    }
}
