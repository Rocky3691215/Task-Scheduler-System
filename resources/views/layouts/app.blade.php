<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Task Scheduler')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Common styles */
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            line-height: 1;
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
            padding-top: 80px; /* To offset fixed header */
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
            min-height: calc(100vh - 120px);
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
            margin-top: 0;
        }
        a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
        nav {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Task Scheduler</h1>
            <nav>
                <a href="{{ url('/') }}">Home</a> |
                @guest
                    <a href="{{ route('login') }}">Login</a> |
                    <a href="{{ url('/sign-up') }}">Sign Up</a>
                @else
                    <a href="{{ route('tasks.index') }}">All Tasks</a> |
                    <a href="{{ route('tasks.create') }}">Create New Task</a> |
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-weight:600;">Logout</button>
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

    @stack('scripts')
    
</body>
</html>