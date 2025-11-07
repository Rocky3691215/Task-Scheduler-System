<!DOCTYPE html>
<!-- master.blade.php -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Task Scheduler')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        /* Common styles */
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            line-height: 1.6;
            background-color: #f8f9fa;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        main {
            padding-top: 80px;
            min-height: calc(100vh - 120px);
            padding-bottom: 60px;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
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
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            border-radius: 6px;
            font-weight: 600;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
        }
        .card-header {
            border-radius: 8px 8px 0 0 !important;
            font-weight: 600;
        }
        .table th {
            font-weight: 600;
            background-color: #4f46e5 !important;
            color: white !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1 class="h3 mb-0">Task Scheduler</h1>
        <nav>
            <a href="{{ url('/') }}" class="me-3"><i class="fas fa-home"></i> Home</a> 
            @guest
                <a href="{{ route('login') }}" class="me-3"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="{{ url('/sign-up') }}"><i class="fas fa-user-plus"></i> Sign Up</a>
            @else
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-weight:600;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @endguest
        </nav>
    </header>

    <main class="container-fluid">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>