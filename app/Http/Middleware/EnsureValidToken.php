<?php

namespace App\Http\Middleware;

use App\Contracts\TokenServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class EnsureValidToken
{
    /**
     * @param TokenServiceInterface $tokenService
     */
    public function __construct(private TokenServiceInterface $tokenService)
    {
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $this->tokenService->validate((string)$request->route('token'));

        $request->attributes->set('page_token', $token);

        return $next($request);
    }
}
