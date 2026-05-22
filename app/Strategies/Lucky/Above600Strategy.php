<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

class Above600Strategy implements LuckyStrategyInterface
{
    public function supports(int $number): bool
    {
        return $number > 600;
    }

    public function calculate(int $number): float
    {
        return $number * 0.50;
    }
}
