<?php

namespace App\Dto\Lucky;

final class SpinPayload
{
    public int   $number = 0;
    public bool  $isWin  = false;
    public float $amount = 0.0;

    /**
     * @param int $userId
     */
    public function __construct(public readonly int $userId)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'number'  => $this->number,
            'is_win'  => $this->isWin,
            'amount'  => $this->amount,
        ];
    }
}
