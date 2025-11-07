<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin List - Task Scheduler</title>

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
        .table {
            width: 100%;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background-color: #4f46e5;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f9fafb;
        }
        .add {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        .add:hover {
            background-color: #4338ca;
            text-decoration: none;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a, .actions button {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .actions a {
            background-color: #f59e0b;
            color: white;
        }
        .actions button {
            background-color: #ef4444;
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            color: #6b7280;
            margin-top: 20px;
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
        <h2>Admin List</h2>
        <a href="{{ route('admin.create') }}" class="add">Add an Admin</a>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($admins) && $admins->count() > 0)
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>
                                    <a href="{{ route('admin.show', $admin->id) }}" style="color: #4f46e5; text-decoration: none;">{{ $admin->name }}</a>
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td class="actions">
                                    <a href="{{ route('admin.edit', $admin->id) }}">Edit</a>
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <h3>No Admins Found</h3>
                <p>Get started by creating your first admin.</p>
                <a href="{{ route('admin.create') }}" class="add">Add First Admin</a>
            </div>
        @endif
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

</body>
</html>