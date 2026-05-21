<?php

namespace App\Models;

use App\Enums\TokenStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property TokenStatus $status {@see TokenStatus}
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 */
class UserToken extends Model
{
    protected $fillable = ['user_id', 'token', 'status'];

    protected $casts = [
        'status' => TokenStatus::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->created_at
            ->addDays(config('token.ttl_days'))
            ->isPast();
    }
}
