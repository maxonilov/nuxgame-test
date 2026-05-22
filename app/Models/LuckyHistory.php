<?php

namespace App\Models;

use App\Builders\LuckyHistoryBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $number
 * @property bool $is_win
 * @property float $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 *
 * @method static LuckyHistoryBuilder query()
 */
class LuckyHistory extends Model
{
    protected $fillable = ['user_id', 'number', 'is_win', 'amount'];

    protected $casts = [
        'is_win' => 'boolean',
        'amount' => 'float',
    ];

    public function newEloquentBuilder($query): LuckyHistoryBuilder
    {
        return new LuckyHistoryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
