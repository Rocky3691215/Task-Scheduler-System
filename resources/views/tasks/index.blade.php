@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
<div class="task-container">
    <div class="header-section">
        <h2>All Tasks</h2>
        <a href="{{ route('tasks.create') }}" class="btn-primary">Create New Task</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($tasks->count() > 0)
        <div class="tasks-table">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr class="priority-{{ $task->priority }}">
                            <td>{{ $task->title }}</td>
                            <td>
                                <span class="status-badge status-{{ $task->status }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="priority-badge priority-{{ $task->priority }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                            <td>{{ $task->assignedUser->name ?? 'Unassigned' }}</td>
                            <td class="actions">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn-info">View</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn-warning">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $tasks->links() }}
        </div>
    @else
        <div class="no-tasks">
            <h3>No tasks found!</h3>
            <p>Create your first task by clicking the button above.</p>
        </div>
    @endif
</div>

<style>
    .task-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .tasks-table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background-color: #4f46e5;
        color: white;
        font-weight: 600;
    }

    .priority-1 { background-color: #f8f9fa; }
    .priority-2 { background-color: #fff3cd; }
    .priority-3 { background-color: #f8d7da; }

    .status-badge, .priority-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-pending { background-color: #6b7280; color: white; }
    .status-in_progress { background-color: #f59e0b; color: white; }
    .status-completed { background-color: #10b981; color: white; }

    .priority-1 { background-color: #10b981; color: white; }
    .priority-2 { background-color: #f59e0b; color: white; }
    .priority-3 { background-color: #ef4444; color: white; }

    .actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-primary, .btn-info, .btn-warning, .btn-danger {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.875rem;
        cursor: pointer;
        display: inline-block;
    }

    .btn-primary { background-color: #4f46e5; color: white; }
    .btn-info { background-color: #3b82f6; color: white; }
    .btn-warning { background-color: #f59e0b; color: white; }
    .btn-danger { background-color: #ef4444; color: white; }

    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .alert-success { background-color: #d1fae5; color: #065f46; }
    .alert-error { background-color: #fee2e2; color: #991b1b; }

    .no-tasks {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
</style>
@endsection