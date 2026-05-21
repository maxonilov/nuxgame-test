<?php

namespace App\Models;

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
 *
 * @property User $user
 */
class LuckyHistory extends Model
{
    protected $fillable = ['user_id', 'number', 'is_win', 'amount'];

    protected $casts = [
        'is_win' => 'boolean',
        'amount' => 'float'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
