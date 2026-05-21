<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

final class Above600Strategy implements LuckyStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function supports(int $number): bool
    {
        return $number > 600;
    }

    /**
     * @inheritDoc
     */
    public function calculate(int $number): float
    {
        return $number * 0.50;
    }
}
