<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    // Constants for better code maintainability
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    const PRIORITY_LOW = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'assigned_to'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
        'priority' => 'integer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'is_overdue',
        'priority_label',
        'status_label',
        'due_date_formatted',
    ];

    /**
     * Get the user assigned to this task.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope a query to only include pending tasks.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include in progress tasks.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    /**
     * Scope a query to only include completed tasks.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope a query to only include overdue tasks.
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->where('status', '!=', self::STATUS_COMPLETED);
    }

    /**
     * Scope a query to order by priority (high to low).
     */
    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    /**
     * Scope a query to order by due date (ascending).
     */
    public function scopeOrderByDueDate($query)
    {
        return $query->orderBy('due_date', 'asc');
    }

    /**
     * Check if the task is overdue.
     */
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->due_date->isPast() 
            && $this->status !== self::STATUS_COMPLETED;
    }

    /**
     * Get the priority label.
     */
    public function getPriorityLabelAttribute(): string
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
            default => 'Unknown',
        };
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            default => 'Unknown',
        };
    }

    /**
     * Get the formatted due date.
     */
    public function getDueDateFormattedAttribute(): ?string
    {
        return $this->due_date?->format('M j, Y g:i A');
    }

    /**
     * Get all available status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    /**
     * Get all available priority options.
     */
    public static function getPriorityOptions(): array
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
        ];
    }

    /**
     * Mark task as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update(['status' => self::STATUS_COMPLETED]);
    }

    /**
     * Check if task can be edited.
     */
    public function canBeEdited(): bool
    {
        return $this->status !== self::STATUS_COMPLETED;
    }

    /**
     * Get the CSS class for priority.
     */
    public function getPriorityClass(): string
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'priority-low',
            self::PRIORITY_MEDIUM => 'priority-medium',
            self::PRIORITY_HIGH => 'priority-high',
            default => 'priority-unknown',
        };
    }

    /**
     * Get the CSS class for status.
     */
    public function getStatusClass(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'status-pending',
            self::STATUS_IN_PROGRESS => 'status-in-progress',
            self::STATUS_COMPLETED => 'status-completed',
            default => 'status-unknown',
        };
    }
}