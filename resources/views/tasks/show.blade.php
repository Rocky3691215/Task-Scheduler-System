@extends('layouts.master')

@section('title', 'Task Details - Task Scheduler')

@section('content')
<div class="task-details-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header Section -->
            <div class="page-header">
                <div class="header-content">
                    <div class="header-text">
                        <h1 class="page-title">
                            <i class="fas fa-eye"></i>
                            Task Details
                        </h1>
                        <p class="page-subtitle">Complete information about the task</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit">
                            <i class="fas fa-edit me-2"></i>
                            Edit Task
                        </a>
                        <a href="{{ route('tasks.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Tasks
                        </a>
                    </div>
                </div>
            </div>

            <!-- Task Details Card -->
            <div class="task-details-card">
                <!-- Basic Information Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-info-circle section-icon"></i>
                        <h3 class="section-title">Basic Information</h3>
                    </div>
                    <div class="section-content">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </div>
                            <div class="detail-value">{{ $task->title }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-align-left"></i>
                                Description
                            </div>
                            <div class="detail-value">
                                {{ $task->description ?: 'No description provided' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task Details Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-cog section-icon"></i>
                        <h3 class="section-title">Task Details</h3>
                    </div>
                    <div class="section-content">
                        <div class="details-grid">
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-tasks"></i>
                                    Status
                                </div>
                                <div class="detail-value">
                                    <span class="status-badge status-{{ $task->status }}">
                                        <i class="status-icon 
                                            @if($task->status == 'pending') fas fa-clock
                                            @elseif($task->status == 'in_progress') fas fa-sync-alt
                                            @else fas fa-check-circle @endif">
                                        </i>
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-flag"></i>
                                    Priority
                                </div>
                                <div class="detail-value">
                                    <span class="priority-badge priority-{{ $task->priority }}">
                                        <i class="priority-icon 
                                            @if($task->priority == 1) fas fa-arrow-down
                                            @elseif($task->priority == 2) fas fa-minus
                                            @else fas fa-arrow-up @endif">
                                        </i>
                                        @if($task->priority == 1) Low Priority
                                        @elseif($task->priority == 2) Medium Priority
                                        @else High Priority @endif
                                    </span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-calendar-day"></i>
                                    Due Date
                                </div>
                                <div class="detail-value">
                                    @if($task->due_date)
                                        <div class="due-date {{ $task->due_date->isPast() && $task->status != 'completed' ? 'overdue' : '' }}">
                                            <i class="fas fa-calendar"></i>
                                            {{ $task->due_date->format('F d, Y') }}
                                            @if($task->due_date->isPast() && $task->status != 'completed')
                                                <span class="overdue-badge">Overdue</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="no-date">No due date set</span>
                                    @endif
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-user-friends"></i>
                                    Assigned To
                                </div>
                                <div class="detail-value">
                                    <div class="assigned-user">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span class="user-name">{{ $task->assignedUser->name ?? 'Unassigned' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata Section -->
                <div class="details-section">
                    <div class="section-header">
                        <i class="fas fa-history section-icon"></i>
                        <h3 class="section-title">Metadata</h3>
                    </div>
                    <div class="section-content">
                        <div class="details-grid">
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-plus-circle"></i>
                                    Created
                                </div>
                                <div class="detail-value">
                                    {{ $task->created_at->format('M d, Y \a\t H:i') }}
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-edit"></i>
                                    Last Updated
                                </div>
                                <div class="detail-value">
                                    {{ $task->updated_at->format('M d, Y \a\t H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-section">
                    <div class="action-buttons">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit-large">
                            <i class="fas fa-edit me-2"></i>
                            Edit Task
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete-large" onclick="return confirm('Are you sure you want to delete this task? This action cannot be undone.')">
                                <i class="fas fa-trash me-2"></i>
                                Delete Task
                            </button>
                        </form>
                        <a href="{{ route('tasks.index') }}" class="btn btn-back-large">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .task-details-container {
        width: 100%;
        min-height: calc(100vh - 140px);
        padding: 2rem 1rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: #6b7280;
        font-weight: 400;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .btn-back {
        background: transparent;
        border-color: #6b7280;
        color: #6b7280;
    }

    .btn-edit:hover, .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .task-details-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .details-section {
        padding: 2rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .details-section:last-child {
        border-bottom: none;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-icon {
        font-size: 1.5rem;
        color: #4f46e5;
        margin-right: 1rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .detail-row {
        display: flex;
        margin-bottom: 1.5rem;
    }

    .detail-label {
        flex: 0 0 200px;
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        flex: 1;
        color: #6b7280;
        line-height: 1.6;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    /* Status and Priority Badges */
    .status-badge, .priority-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-pending { background: #f3f4f6; color: #6b7280; }
    .status-in_progress { background: #fef3c7; color: #d97706; }
    .status-completed { background: #d1fae5; color: #065f46; }

    .priority-1 { background: #d1fae5; color: #065f46; }
    .priority-2 { background: #fef3c7; color: #d97706; }
    .priority-3 { background: #fee2e2; color: #dc2626; }

    /* Due Date */
    .due-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .due-date.overdue {
        color: #dc2626;
    }

    .overdue-badge {
        background: #fee2e2;
        color: #dc2626;
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .no-date {
        color: #9ca3af;
        font-style: italic;
    }

    /* Assigned User */
    .assigned-user {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
    }

    .user-name {
        font-weight: 500;
        color: #374151;
    }

    /* Action Section */
    .action-section {
        padding: 2rem;
        background: #f8fafc;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-edit-large, .btn-delete-large, .btn-back-large {
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        min-width: 160px;
        justify-content: center;
    }

    .btn-edit-large {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .btn-delete-large {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-back-large {
        background: transparent;
        border-color: #6b7280;
        color: #6b7280;
    }

    .btn-edit-large:hover, .btn-delete-large:hover, .btn-back-large:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .delete-form {
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .task-details-container {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .page-title {
            font-size: 2rem;
            justify-content: center;
        }

        .header-actions {
            justify-content: center;
        }

        .details-section {
            padding: 1.5rem;
        }

        .detail-row {
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-label {
            flex: none;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-edit-large, .btn-delete-large, .btn-back-large {
            width: 100%;
            min-width: auto;
        }
    }
</style>
@endsection