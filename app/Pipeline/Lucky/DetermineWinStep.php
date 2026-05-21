<?php

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use Closure;

final class DetermineWinStep
{
    /**
     * @param SpinPayload $payload
     * @param Closure $next
     * @return mixed
     */
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        $payload->isWin = $payload->number % 2 === 0;

        return $next($payload);
    }
}
