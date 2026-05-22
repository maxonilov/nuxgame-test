<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserTokenBuilder extends Builder
{
    public function whereToken(string $token): self
    {
        return $this->where('token', $token);
    }
}
