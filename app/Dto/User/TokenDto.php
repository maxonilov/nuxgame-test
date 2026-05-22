<?php

namespace App\Dto\User;

class TokenDto
{
    public ?string $token;

    public function __construct(public int $userId) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'token' => $this->token,
        ];
    }
}
