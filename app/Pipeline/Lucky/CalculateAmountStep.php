<?php

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use App\Strategies\LuckyContext;
use Closure;

final class CalculateAmountStep
{
    /**
     * @param SpinPayload $payload
     * @param Closure $next
     * @return mixed
     */
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        if ($payload->isWin) {
            $payload->amount = LuckyContext::getByNumber($payload->number)->calculate($payload->number);
        }

        return $next($payload);
    }
}
