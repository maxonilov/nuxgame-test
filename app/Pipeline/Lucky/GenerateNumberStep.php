<?php

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use Closure;
use Random\RandomException;

final class GenerateNumberStep
{
    /**
     * @param SpinPayload $payload
     * @param Closure $next
     * @return mixed
     * @throws RandomException
     */
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        $payload->number = random_int(1, 1000);

        return $next($payload);
    }
}
