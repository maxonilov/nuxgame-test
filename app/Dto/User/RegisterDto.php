<?php

namespace App\Dto\User;

readonly class RegisterDto
{
    /**
     * @param string $username
     * @param string $phoneNumber
     */
    public function __construct(
        public string $username,
        public string $phoneNumber,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'username'     => $this->username,
            'phone_number' => $this->phoneNumber,
        ];
    }
}
