<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Dto\User\RegisterDto;
use App\Dto\User\TokenDto;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

readonly class UserService implements RegisterServiceInterface
{
    public function __construct(private TokenServiceInterface $tokenService) {}

    /**
     * @throws \Throwable
     */
    public function make(RegisterDto $dto): UserToken
    {
        return DB::transaction(function () use ($dto) {
            $user = User::query()->create($dto->toArray());

            return $this->tokenService->store(
                new TokenDto(
                    userId: $this->authorize($user)->id,
                )
            );
        });
    }

    /**
     * @throws \Throwable
     */
    public function deactivate(UserToken $token): void
    {
        $this->tokenService->deactivate($token);

        Auth::logout();
    }

    private function authorize(User $user): User
    {
        Auth::login($user);

        return $user;
    }
}
