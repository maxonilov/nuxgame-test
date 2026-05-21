<?php

namespace App\Contracts;

use App\Models\LuckyHistory;
use Illuminate\Database\Eloquent\Collection;

interface LuckyHistoryRepositoryInterface
{
    /**
     * @param array $data
     * @return LuckyHistory
     */
    public function create(array $data): LuckyHistory;

    /**
     * @param int $userId
     * @param int $limit
     * @return Collection
     */
    public function getLastByUserId(int $userId, int $limit = 3): Collection;
}
