<?php

namespace Tests\Unit;

use App\Dto\Lucky\SpinPayload;
use App\Pipeline\Lucky\CalculateAmountStep;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalculateAmountStepTest extends TestCase
{
    private CalculateAmountStep $step;

    protected function setUp(): void
    {
        $this->step = new CalculateAmountStep;
    }

    #[DataProvider('winAmountProvider')]
    public function test_calculates_correct_amount_per_range(int $number, float $expected): void
    {
        $payload = new SpinPayload(userId: 1);
        $payload->number = $number;
        $payload->isWin = true;

        $this->step->handle($payload, fn ($p) => $p);

        $this->assertEqualsWithDelta($expected, $payload->amount, 0.001);
    }

    public static function winAmountProvider(): array
    {
        return [
            '>900 → 70%' => [950,  665.0],  // 950 * 0.70
            '>600 → 50%' => [700,  350.0],  // 700 * 0.50
            '>300 → 30%' => [400,  120.0],  // 400 * 0.30
            '≤300 → 10%' => [200,   20.0],  // 200 * 0.10
        ];
    }

    public function test_amount_stays_zero_when_not_win(): void
    {
        $payload = new SpinPayload(userId: 1);
        $payload->number = 951;
        $payload->isWin = false;

        $this->step->handle($payload, fn ($p) => $p);

        $this->assertEquals(0.0, $payload->amount);
    }
}
