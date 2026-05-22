<?php

namespace App\Contracts;

use App\Models\LuckyHistory;

interface LuckyServiceInterface
{
    public function spin(int $userId): LuckyHistory;
}
