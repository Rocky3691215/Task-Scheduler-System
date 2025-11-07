<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sync_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_sync_id',
        'status',
        'message',
    ];

    /**
     * Get the parent account sync that this history record belongs to.
     */
    public function accountSync(): BelongsTo
    {
        return $this->belongsTo(AccountSync::class, 'account_sync_id', 'syncId');
    }
}
