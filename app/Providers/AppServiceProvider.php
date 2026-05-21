<?php

namespace App\Providers;

use App\Contracts\LuckyHistoryRepositoryInterface;
use App\Contracts\LuckyServiceInterface;
use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserTokenRepositoryInterface;
use App\Repositories\LuckyHistoryRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;
use App\Services\LuckyService;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerRepositories(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserTokenRepositoryInterface::class, UserTokenRepository::class);
        $this->app->bind(LuckyHistoryRepositoryInterface::class, LuckyHistoryRepository::class);
    }

    private function registerServices(): void
    {
        $this->app->bind(RegisterServiceInterface::class, UserService::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);
        $this->app->bind(LuckyServiceInterface::class, LuckyService::class);
    }

    public function boot(): void
    {
    }
}
