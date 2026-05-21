<?php

namespace App\Strategies\Lucky;

use App\Contracts\LuckyStrategyInterface;

final class DefaultStrategy implements LuckyStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function supports(int $number): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function calculate(int $number): float
    {
        return $number * 0.10;
    }
}
