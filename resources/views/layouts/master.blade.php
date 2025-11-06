<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Task Scheduler')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    <style>
        /* Common styles */
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            line-height: 1.6;
            background-color: #f3f4f6;
            color: #374151;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: 1rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        main {
            padding-top: 100px;
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
            min-height: calc(100vh - 160px);
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            height: 60px;
            text-align: center;
            padding: 1rem 0;
            background-color: #4f46e5;
            color: white;
            margin-top: 2rem;
        }
        a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        a:hover {
            text-decoration: underline;
            transform: translateY(-1px);
        }
        nav {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logo i {
            font-size: 1.75rem;
        }
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .logout-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-weight: 600;
            font-family: inherit;
            font-size: inherit;
            padding: 0;
        }
        .logout-btn:hover {
            text-decoration: underline;
            transform: translateY(-1px);
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-tasks"></i>
                Task Scheduler
            </div>
            <nav>
                <div class="nav-links">
                    <a href="{{ url('/') }}">Home</a>
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ url('/sign-up') }}">Sign Up</a>
                    @else
                        <a href="{{ route('tasks.index') }}">All Tasks</a>
                        <a href="{{ route('tasks.create') }}">Create Task</a>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    @endguest
                </div>
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