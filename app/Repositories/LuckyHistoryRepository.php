<?php

namespace App\Repositories;

use App\Contracts\LuckyHistoryRepositoryInterface;
use App\Models\LuckyHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class LuckyHistoryRepository implements LuckyHistoryRepositoryInterface
{
    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return LuckyHistory::query();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): LuckyHistory
    {
        return $this->query()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function getLastByUserId(int $userId, int $limit = 3): Collection
    {
        return $this->query()
            ->where('user_id', $userId)
            ->latest()
            ->limit($limit)
            ->get();
    }
}
