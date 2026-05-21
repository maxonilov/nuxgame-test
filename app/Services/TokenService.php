<?php

namespace App\Services;

use App\Contracts\TokenServiceInterface;
use App\Contracts\UserTokenRepositoryInterface;
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
    /**
     * @param UserTokenRepositoryInterface $tokenRepository
     */
    public function __construct(private UserTokenRepositoryInterface $tokenRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function store(TokenDto $dto): UserToken
    {
        $dto->token = Str::random(8);

        return $this->tokenRepository->create($dto->toArray());
    }

    /**
     * @inheritDoc
     */
    public function findByToken(string $token): ?UserToken
    {
        return $this->tokenRepository->findByToken($token);
    }

    /**
     * @inheritDoc
     */
    public function validate(string $token): UserToken
    {
        $userToken = $this->findByToken($token);

        return match (true) {
            !$userToken => throw new NotFoundHttpException(),
            $userToken->isExpired() => throw new TokenExpiredException(),
            $userToken->status !== TokenStatus::Active => throw new TokenAccessDeniedException(),
            Auth::id() !== $userToken->user_id => throw new TokenAccessDeniedException(),
            default => $userToken,
        };
    }

    /**
     * @inheritDoc
     */
    public function regenerate(UserToken $token): UserToken
    {
        $this->tokenRepository->delete($token);

        return $this->store(new TokenDto(userId: $token->user_id));
    }

    /**
     * @inheritDoc
     */
    public function deactivate(UserToken $token): void
    {
        $this->tokenRepository->setStatus($token, TokenStatus::Inactive);
    }
}
