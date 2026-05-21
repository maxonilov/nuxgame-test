<?php

namespace App\Contracts;

use App\Models\LuckyHistory;

interface LuckyServiceInterface
{
    /**
     * @param int $userId
     * @return LuckyHistory
     */
    public function spin(int $userId): LuckyHistory;
}
