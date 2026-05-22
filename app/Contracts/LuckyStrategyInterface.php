<?php

namespace App\Contracts;

interface LuckyStrategyInterface
{
    public function supports(int $number): bool;

    public function calculate(int $number): float;
}
