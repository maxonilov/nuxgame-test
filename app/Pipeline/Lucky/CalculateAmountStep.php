<?php

declare(strict_types=1);

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use App\Strategies\LuckyContext;
use Closure;

class CalculateAmountStep
{
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        if ($payload->isWin) {
            $payload->amount = LuckyContext::getByNumber($payload->number)->calculate($payload->number);
        }

        return $next($payload);
    }
}
