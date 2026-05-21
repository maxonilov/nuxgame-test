<?php

namespace App\Contracts;

interface LuckyStrategyInterface
{
    /**
     * @param int $number
     * @return bool
     */
    public function supports(int $number): bool;

    /**
     * @param int $number
     * @return float
     */
    public function calculate(int $number): float;
}
