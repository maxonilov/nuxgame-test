<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

class DefaultStrategy implements LuckyStrategyInterface
{
    public function supports(int $number): bool
    {
        return true;
    }

    public function calculate(int $number): float
    {
        return $number * 0.10;
    }
}
