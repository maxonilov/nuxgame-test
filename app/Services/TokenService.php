<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\TokenServiceInterface;
use App\Dto\User\TokenDto;
use App\Enums\TokenStatus;
use App\Exceptions\TokenAccessDeniedException;
use App\Exceptions\TokenExpiredException;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class TokenService implements TokenServiceInterface
{
    public function store(TokenDto $dto): UserToken
    {
        $dto->token = Str::random(8);

        return UserToken::query()->create($dto->toArray());
    }

    public function findByToken(string $token): ?UserToken
    {
        return UserToken::query()->whereToken($token)->first();
    }

    /**
     * {@inheritDoc}
     */
    public function validate(string $token): UserToken
    {
        $userToken = $this->findByToken($token);

        return match (true) {
            ! $userToken => throw new NotFoundHttpException,
            $userToken->isExpired() => throw new TokenExpiredException,
            $userToken->status !== TokenStatus::Active => throw new TokenAccessDeniedException,
            Auth::id() !== $userToken->user_id => throw new TokenAccessDeniedException,
            default => $userToken,
        };
    }

    public function regenerate(UserToken $token): UserToken
    {
        $token->delete();

        return $this->store(new TokenDto(userId: $token->user_id));
    }

    public function deactivate(UserToken $token): void
    {
        $token->update(['status' => TokenStatus::Inactive]);
    }
}
