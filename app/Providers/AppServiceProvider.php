<?php

namespace App\Providers;

use App\Contracts\LuckyServiceInterface;
use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Services\LuckyService;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RegisterServiceInterface::class, UserService::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);
        $this->app->bind(LuckyServiceInterface::class, LuckyService::class);
    }

    public function boot(): void {}
}
