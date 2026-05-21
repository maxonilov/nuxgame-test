<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LuckyController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\EnsureValidToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'show'])->name('register');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

Route::prefix('/page/{token}')
    ->middleware(EnsureValidToken::class)
    ->group(function () {
        Route::get('/', [PageController::class, 'show'])->name('page.show');
        Route::post('/regenerate', [PageController::class, 'regenerate'])->name('page.regenerate');
        Route::delete('/deactivate', [PageController::class, 'deactivate'])->name('page.deactivate');
        Route::post('/lucky', [LuckyController::class, 'spin'])->name('page.lucky');
        Route::get('/history', [HistoryController::class, 'index'])->name('page.history');
    });
