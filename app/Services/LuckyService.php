<?php

namespace App\Services;

use App\Contracts\LuckyHistoryRepositoryInterface;
use App\Contracts\LuckyServiceInterface;
use App\Dto\Lucky\SpinPayload;
use App\Models\LuckyHistory;
use App\Pipeline\Lucky\CalculateAmountStep;
use App\Pipeline\Lucky\DetermineWinStep;
use App\Pipeline\Lucky\GenerateNumberStep;
use Illuminate\Pipeline\Pipeline;

final readonly class LuckyService implements LuckyServiceInterface
{
    /**
     * @param LuckyHistoryRepositoryInterface $historyRepository
     * @param Pipeline $pipeline
     */
    public function __construct(
        private LuckyHistoryRepositoryInterface $historyRepository,
        private Pipeline $pipeline,
    ) {
    }

    /**
     * @inheritDoc
     */
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

        return $this->historyRepository->create(
            $payload->toArray()
        );
    }
}
