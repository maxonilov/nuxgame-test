<?php

declare(strict_types=1);

namespace App\Pipeline\Lucky;

use App\Dto\Lucky\SpinPayload;
use Closure;
use Random\RandomException;

class GenerateNumberStep
{
    /**
     * @throws RandomException
     */
    public function handle(SpinPayload $payload, Closure $next): mixed
    {
        $payload->number = random_int(1, 1000);

        return $next($payload);
    }
}
