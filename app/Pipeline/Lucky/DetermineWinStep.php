<?php

declare(strict_types=1);

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use Closure;

class DetermineWinStep
{
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        $payload->isWin = $payload->number % 2 === 0;

        return $next($payload);
    }
}
