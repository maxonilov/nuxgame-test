<?php

namespace App\Strategies;

use App\Contracts\LuckyStrategyInterface;
use App\Exceptions\NoStrategyResolvedException;
use App\Strategies\Lucky\Above300Strategy;
use App\Strategies\Lucky\Above600Strategy;
use App\Strategies\Lucky\Above900Strategy;
use App\Strategies\Lucky\DefaultStrategy;

final class LuckyContext
{
    /** @var class-string<LuckyStrategyInterface>[] */
    private const array STRATEGIES = [
        Above900Strategy::class,
        Above600Strategy::class,
        Above300Strategy::class,
        DefaultStrategy::class,
    ];

    /**
     * @param int $number
     * @return LuckyStrategyInterface
     */
    public static function getByNumber(int $number): LuckyStrategyInterface
    {
        foreach (self::STRATEGIES as $strategyClass) {
            $strategy = new $strategyClass();

            if ($strategy->supports($number)) {
                return $strategy;
            }
        }

        throw new NoStrategyResolvedException($number);
    }
}
