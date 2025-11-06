@extends('layouts.master')

@section('title', 'Home - Task Scheduler')

@section('content')
<div class="home-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="fas fa-tasks hero-icon"></i>
                Welcome to Task Scheduler
            </h1>
            <p class="hero-subtitle">Efficiently manage your team's tasks and projects in one place</p>
            <div class="hero-actions">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i>
                    View All Tasks
                </a>
                <a href="{{ route('tasks.create') }}" class="btn btn-secondary">
                    <i class="fas fa-plus"></i>
                    Create New Task
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-section">
        <h2 class="section-title">Quick Overview</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pendingTasks }}</h3>
                    <p>Pending</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $inProgressTasks }}</h3>
                    <p>In Progress</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $completedTasks }}</h3>
                    <p>Completed</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks -->
    @if($recentTasks->count() > 0)
    <div class="recent-tasks-section">
        <h2 class="section-title">Recent Tasks</h2>
        <div class="tasks-grid">
            @foreach($recentTasks as $task)
            <div class="task-card">
                <div class="task-header">
                    <h4 class="task-title">{{ Str::limit($task->title, 30) }}</h4>
                    <span class="status-badge status-{{ $task->status }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>
                <div class="task-body">
                    @if($task->description)
                    <p class="task-description">{{ Str::limit($task->description, 80) }}</p>
                    @endif
                    <div class="task-meta">
                        <div class="meta-item">
                            <i class="fas fa-flag priority-{{ $task->priority }}"></i>
                            @if($task->priority == 1) Low
                            @elseif($task->priority == 2) Medium
                            @else High @endif
                        </div>
                        @if($task->due_date)
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            {{ $task->due_date->format('M d') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="task-footer">
                    <div class="assigned-user">
                        <i class="fas fa-user"></i>
                        {{ $task->assignedUser->name ?? 'Unassigned' }}
                    </div>
                    <a href="{{ route('tasks.show', $task->id) }}" class="view-task-btn">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('tasks.index') }}" class="btn btn-outline">
                View All Tasks
            </a>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-tasks"></i>
        </div>
        <h2>No tasks yet!</h2>
        <p>Get started by creating your first task</p>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create Your First Task
        </a>
    </div>
    @endif
</div>

<style>
    .home-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Hero Section */
    .hero-section {
        text-align: center;
        padding: 3rem 0;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 20px;
        color: white;
        margin-bottom: 3rem;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .hero-icon {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: white;
        color: #4f46e5;
    }

    .btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-outline {
        background: transparent;
        color: #4f46e5;
        border: 2px solid #4f46e5;
    }

    /* Sections */
    .section-title {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        color: #1f2937;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .stat-icon.total { background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; }
    .stat-icon.pending { background: linear-gradient(135deg, #6b7280, #9ca3af); color: white; }
    .stat-icon.progress { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; }
    .stat-icon.completed { background: linear-gradient(135deg, #10b981, #34d399); color: white; }

    .stat-content h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        color: #1f2937;
    }

    .stat-content p {
        margin: 0;
        color: #6b7280;
        font-weight: 500;
        font-size: 1.1rem;
    }

    /* Tasks Grid */
    .tasks-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .task-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }

    .task-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .task-title {
        font-weight: 600;
        color: #1f2937;
        margin: 0;
        flex: 1;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-pending { background: #f3f4f6; color: #6b7280; }
    .status-in_progress { background: #fef3c7; color: #d97706; }
    .status-completed { background: #d1fae5; color: #065f46; }

    .task-description {
        color: #6b7280;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .task-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .priority-1 { color: #10b981; }
    .priority-2 { color: #f59e0b; }
    .priority-3 { color: #ef4444; }

    .task-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
    }

    .assigned-user {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .view-task-btn {
        background: #4f46e5;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .view-task-btn:hover {
        background: #4338ca;
        transform: translateY(-1px);
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
            flex-direction: column;
        }

        .hero-actions {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 200px;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .tasks-grid {
            grid-template-columns: 1fr;
        }

        .task-header {
            flex-direction: column;
            gap: 0.5rem;
        }

        .task-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .view-task-btn {
            text-align: center;
        }
    }
</style>
@endsection