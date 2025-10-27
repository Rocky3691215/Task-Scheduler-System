<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountSync extends Model
{
    use HasFactory;

    protected $table = 'account_sync';
    protected $primaryKey = 'syncId';

    protected $fillable = [
        'lastSyncTime',
        'deviceId',
        'userId',
    ];

    protected $casts = [
        'lastSyncTime' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the account sync.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * Scope a query to only include syncs for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('userId', $userId);
    }

    /**
     * Scope a query to only include recent syncs.
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('lastSyncTime', '>=', now()->subDays($days));
    }

    /**
     * Check if the sync is recent (within last 24 hours).
     */
    public function isRecent(): bool
    {
        return $this->lastSyncTime && $this->lastSyncTime->isAfter(now()->subDay());
    }

    /**
     * Get the sync status.
     */
    public function getStatusAttribute(): string
    {
        if (!$this->lastSyncTime) {
            return 'Never';
        }

        if ($this->isRecent()) {
            return 'Recent';
        }

        return 'Outdated';
    }
}
