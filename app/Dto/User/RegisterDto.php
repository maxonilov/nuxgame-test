<?php

namespace App\Dto\User;

readonly class RegisterDto
{
    public function __construct(
        public string $username,
        public string $phoneNumber,
    ) {}

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'phone_number' => $this->phoneNumber,
        ];
    }
}
