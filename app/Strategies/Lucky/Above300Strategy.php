<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

final class Above300Strategy implements LuckyStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function supports(int $number): bool
    {
        return $number > 300;
    }

    /**
     * @inheritDoc
     */
    public function calculate(int $number): float
    {
        return $number * 0.30;
    }
}
