<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\LuckyServiceInterface;
use App\Dto\Lucky\SpinPayload;
use App\Models\LuckyHistory;
use App\Pipeline\Lucky\CalculateAmountStep;
use App\Pipeline\Lucky\DetermineWinStep;
use App\Pipeline\Lucky\GenerateNumberStep;
use Illuminate\Pipeline\Pipeline;

readonly class LuckyService implements LuckyServiceInterface
{
    public function __construct(private Pipeline $pipeline) {}

    public function spin(int $userId): LuckyHistory
    {
        /** @var SpinPayload $payload */
        $payload = $this->pipeline
            ->send(new SpinPayload($userId))
            ->through([
                GenerateNumberStep::class,
                DetermineWinStep::class,
                CalculateAmountStep::class,
            ])->thenReturn();

        return $this->saveHistory($payload);
    }

    private function saveHistory(SpinPayload $payload): LuckyHistory
    {
        return LuckyHistory::query()->create($payload->toArray());
    }
}
