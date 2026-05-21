<?php

namespace App\Services;

use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Dto\User\RegisterDto;
use App\Dto\User\TokenDto;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

readonly class UserService implements RegisterServiceInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param TokenServiceInterface $tokenService
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TokenServiceInterface $tokenService,
    ) {
    }

    /**
     * @inheritDoc
     * @throws \Throwable
     */
    public function make(RegisterDto $dto): UserToken
    {
        return DB::transaction(function () use ($dto) {
            $user = $this->userRepository->create($dto->toArray());

            return $this->tokenService->store(
                new TokenDto(
                    userId: $this->authorize($user)->id,
                )
            );
        });
    }

    /**
     * @inheritDoc
     * @throws \Throwable
     */
    public function deactivate(UserToken $token): void
    {
        $this->tokenService->deactivate($token);

        Auth::logout();
    }

    /**
     * @param User $user
     * @return User
     */
    private function authorize(User $user): User
    {
        Auth::login($user);

        return $user;
    }
}
