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
            line-height: 1.6;
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
        }
        .page-title {
            font-size: 1.875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1rem;
        }
        .add-button-container {
            margin-bottom: 1.5rem;
        }
        .add {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
        }
        .add:hover {
            background-color: #4338ca;
            text-decoration: none;
        }
        .table {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
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
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        tr:last-child td {
            border-bottom: none;
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
            margin-top: 2rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin: 0 0.5rem;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1>@yield('title', 'Task Scheduler')</h1>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ url('/sign-up') }}">Sign Up</a>
            @else
                <a href="{{ route('users.index') }}">Users</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-weight:600;">Logout</button>
                </form>
            @endguest
        </nav>
    </header>

    <main>
        @hasSection('content')
            {{-- Render legacy full-content sections when present (keeps backward compatibility) --}}
            @yield('content')
        @else
            <h2 class="page-title">@yield('page')</h2>
            
            <div class="add-button-container">
                @yield('addbtn')
            </div>

            @yield('table')
        @endif
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>
