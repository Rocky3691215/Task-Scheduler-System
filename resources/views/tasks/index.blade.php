@extends('layouts.app')

@section('title', 'All Tasks - Task Scheduler')

@section('content')
<div class="tasks-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title">
                    <i class="fas fa-tasks"></i>
                    All Tasks
                </h1>
                <p class="page-subtitle">Manage and track all your team's tasks in one place</p>
            </div>
            <a href="{{ route('tasks.create') }}" class="btn-create-task">
                <i class="fas fa-plus-circle"></i>
                Create New Task
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Tasks Content -->
    @if($tasks->count() > 0)
        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tasks->total() }}</h3>
                    <p>Total Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tasks->where('status', 'pending')->count() }}</h3>
                    <p>Pending</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tasks->where('status', 'in_progress')->count() }}</h3>
                    <p>In Progress</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $tasks->where('status', 'completed')->count() }}</h3>
                    <p>Completed</p>
                </div>
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="tasks-card">
            <div class="table-responsive">
                <table class="tasks-table">
                    <thead>
                        <tr>
                            <th class="task-title">Task Title</th>
                            <th class="task-status">Status</th>
                            <th class="task-priority">Priority</th>
                            <th class="task-due-date">Due Date</th>
                            <th class="task-assigned">Assigned To</th>
                            <th class="task-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr class="task-row priority-{{ $task->priority }}">
                                <td class="task-title-cell">
                                    <div class="task-title-content">
                                        <h4 class="task-name">{{ Str::limit($task->title, 40) }}</h4>
                                        @if($task->description)
                                            <p class="task-description">{{ Str::limit($task->description, 50) }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="task-status-cell">
                                    <span class="status-badge status-{{ $task->status }}">
                                        <i class="status-icon 
                                            @if($task->status == 'pending') fas fa-clock
                                            @elseif($task->status == 'in_progress') fas fa-sync-alt
                                            @else fas fa-check-circle @endif">
                                        </i>
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td class="task-priority-cell">
                                    <span class="priority-badge priority-{{ $task->priority }}">
                                        <i class="priority-icon 
                                            @if($task->priority == 1) fas fa-arrow-down
                                            @elseif($task->priority == 2) fas fa-minus
                                            @else fas fa-arrow-up @endif">
                                        </i>
                                        @if($task->priority == 1) Low
                                        @elseif($task->priority == 2) Medium
                                        @else High @endif
                                    </span>
                                </td>
                                <td class="task-due-date-cell">
                                    @if($task->due_date)
                                        <div class="due-date {{ $task->due_date->isPast() && $task->status != 'completed' ? 'overdue' : '' }}">
                                            <i class="fas fa-calendar"></i>
                                            {{ $task->due_date->format('M d, Y') }}
                                            @if($task->due_date->isPast() && $task->status != 'completed')
                                                <span class="overdue-badge">Overdue</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="no-date">No due date</span>
                                    @endif
                                </td>
                                <td class="task-assigned-cell">
                                    <div class="assigned-user">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span class="user-name">{{ $task->assignedUser->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>
                                <td class="task-actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn-action btn-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action btn-edit" title="Edit Task">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Delete Task" onclick="return confirm('Are you sure you want to delete this task?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($tasks->hasPages())
            <div class="pagination-container">
                {{ $tasks->links() }}
            </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-tasks"></i>
            </div>
            <h2>No tasks found!</h2>
            <p>Get started by creating your first task for your team.</p>
            <a href="{{ route('tasks.create') }}" class="btn-create-empty">
                <i class="fas fa-plus-circle"></i>
                Create Your First Task
            </a>
        </div>
    @endif
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .tasks-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Styles */
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

    .header-text {
        flex: 1;
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

    .page-title i {
        font-size: 2.25rem;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: #6b7280;
        font-weight: 400;
    }

    .btn-create-task {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-create-task:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }

    /* Alert Styles */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-error {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    /* Stats Overview */
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.total { background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; }
    .stat-icon.pending { background: linear-gradient(135deg, #6b7280, #9ca3af); color: white; }
    .stat-icon.progress { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; }
    .stat-icon.completed { background: linear-gradient(135deg, #10b981, #34d399); color: white; }

    .stat-info h3 {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        color: #1f2937;
    }

    .stat-info p {
        margin: 0;
        color: #6b7280;
        font-weight: 500;
    }

    /* Tasks Card */
    .tasks-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .tasks-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tasks-table th {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tasks-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .task-row:hover {
        background-color: #f8fafc;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    /* Priority Backgrounds */
    .priority-1 { background-color: #f8f9fa; }
    .priority-2 { background-color: #fff3cd; }
    .priority-3 { background-color: #f8d7da; }

    /* Task Cells */
    .task-title-cell {
        min-width: 250px;
    }

    .task-name {
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 0.25rem 0;
    }

    .task-description {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        line-height: 1.4;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-pending { background: #f3f4f6; color: #6b7280; }
    .status-in_progress { background: #fef3c7; color: #d97706; }
    .status-completed { background: #d1fae5; color: #065f46; }

    /* Priority Badges */
    .priority-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-view { background: #3b82f6; color: white; }
    .btn-edit { background: #f59e0b; color: white; }
    .btn-delete { background: #ef4444; color: white; }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-state h2 {
        font-size: 1.75rem;
        color: #374151;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .btn-create-empty {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-create-empty:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .tasks-container {
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

        .stats-overview {
            grid-template-columns: repeat(2, 1fr);
        }

        .tasks-table th,
        .tasks-table td {
            padding: 1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 480px) {
        .stats-overview {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection