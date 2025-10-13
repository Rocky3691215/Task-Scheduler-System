<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            width: 100%;
        }
        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: #111827;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .btn {
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out;
        }
        .btn:hover {
            background-color: #4338ca;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 1.5rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 1rem;
            line-height: 1.6;
        }
        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .action-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease-in-out;
            margin-right: 1rem;
        }
        .action-link:hover {
            color: #4338ca;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        .status-in_progress {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        .status-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        .priority-high {
            color: #dc2626;
            font-weight: 600;
        }
        .priority-medium {
            color: #ea580c;
            font-weight: 600;
        }
        .priority-low {
            color: #16a34a;
            font-weight: 600;
        }
        .overdue {
            color: #dc2626;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tasks List</h1>
        
        <div class="header-actions">
            <div></div> <!-- Empty div for spacing -->
            <a href="{{ route('tasks.create') }}" class="btn">Create New Task</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>
                        <strong>{{ $task->title }}</strong>
                        @if($task->description)
                        <br><span class="text-gray-600 text-sm">{{ Str::limit($task->description, 50) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $task->status }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $priorityText = match($task->priority) {
                                1 => 'Low',
                                2 => 'Medium', 
                                3 => 'High',
                                default => 'Low'
                            };
                            $priorityClass = match($task->priority) {
                                1 => 'priority-low',
                                2 => 'priority-medium',
                                3 => 'priority-high',
                                default => 'priority-low'
                            };
                        @endphp
                        <span class="{{ $priorityClass }}">{{ $priorityText }}</span>
                    </td>
                    <td>
                        @if($task->due_date)
                            @php
                                $isOverdue = $task->due_date < now() && $task->status != 'completed';
                            @endphp
                            <span class="{{ $isOverdue ? 'overdue' : '' }}">
                                {{ $task->due_date->format('M j, Y') }}
                            </span>
                        @else
                            <span class="text-gray-400">No due date</span>
                        @endif
                    </td>
                    <td>
                        @if($task->assignedUser)
                            {{ $task->assignedUser->first_name }} {{ $task->assignedUser->last_name }}
                        @else
                            <span class="text-gray-400">Unassigned</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="action-link">View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="action-link">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link text-red-600" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($tasks->isEmpty())
        <div class="text-center py-8 text-gray-500">
            No tasks found. <a href="{{ route('tasks.create') }}" class="text-blue-600 hover:text-blue-800">Create your first task</a>
        </div>
        @endif

        @if($tasks->hasPages())
        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
        @endif
    </div>
</body>
</html>