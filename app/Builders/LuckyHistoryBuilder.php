<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class LuckyHistoryBuilder extends Builder
{
    public function getLastByUser(int $userId, int $limit = 3): self
    {
        return $this->where('user_id', $userId)
            ->latest()
            ->limit($limit);
    }
}
