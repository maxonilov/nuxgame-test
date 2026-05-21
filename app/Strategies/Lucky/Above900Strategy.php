<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

final class Above900Strategy implements LuckyStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function supports(int $number): bool
    {
        return $number > 900;
    }

    /**
     * @inheritDoc
     */
    public function calculate(int $number): float
    {
        return $number * 0.70;
    }
}
