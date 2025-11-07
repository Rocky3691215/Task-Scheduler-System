<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Details - Task Scheduler</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            background-color: #f3f4f6;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        main {
            padding-top: 70px;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 40px;
            text-align: center;
            padding: 0.5rem 0;
            background-color: #4f46e5;
            color: white;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .admin-details {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-label {
            width: 120px;
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #6b7280;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
        }
        .btn-edit {
            background-color: #f59e0b;
            color: white;
        }
        .btn-back {
            background-color: #6b7280;
            color: white;
        }
        .btn-delete {
            background-color: #ef4444;
            color: white;
        }
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Task Scheduler</h1>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <a href="{{ url('/admin') }}">Admins</a>
            <a href="{{ url('/users') }}">Users</a>
            <a href="{{ url('/schedules') }}">Schedules</a>
            <a href="{{ url('/tasks') }}">Tasks</a>
            <a href="{{ url('/settings') }}">Settings</a>
        </nav>
    </header>

    <main>
        <h2>Admin Details</h2>

        @if(isset($admin) && $admin)
            <div class="admin-details">
                <div class="detail-row">
                    <div class="detail-label">ID:</div>
                    <div class="detail-value">{{ $admin->id }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value">{{ $admin->name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value">{{ $admin->email }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Created At:</div>
                    <div class="detail-value">{{ $admin->created_at->format('M j, Y g:i A') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Updated At:</div>
                    <div class="detail-value">{{ $admin->updated_at->format('M j, Y g:i A') }}</div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-edit">Edit Admin</a>
                <a href="{{ route('admin.index') }}" class="btn btn-back">Back to List</a>
                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this admin?')">Delete Admin</button>
                </form>
            </div>
        @else
            <div style="background: #fef2f2; color: #dc2626; padding: 20px; border-radius: 8px; margin-top: 20px;">
                <h3>Admin Not Found</h3>
                <p>The admin you're looking for doesn't exist.</p>
                <a href="{{ route('admin.index') }}" class="btn btn-back">Back to Admin List</a>
            </div>
        @endif
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

</body>
</html>