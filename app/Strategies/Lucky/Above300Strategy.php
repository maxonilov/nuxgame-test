<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

class Above300Strategy implements LuckyStrategyInterface
{
    public function supports(int $number): bool
    {
        return $number > 300;
    }

    public function calculate(int $number): float
    {
        return $number * 0.30;
    }
}
