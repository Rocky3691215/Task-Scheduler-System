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
        
        /* Button styles */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-primary {
            background-color: #4f46e5;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
        }
        
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #4b5563;
        }
        
        .btn-full {
            width: 100%;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
            color: #1f2937;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Card styles */
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
            margin-bottom: 1.5rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background-color: #f9fafb;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
        }

        .table tr:hover {
            background-color: #f9fafb;
        }

        /* Alert styles */
        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Link styles */
        .link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .link:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: .5rem;
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
            position: relative;
            bottom: 0;
            width: 100%;
            height: 40px;
            text-align: center;
            padding: 0.5rem 0;
            background-color: #4f46e5;
            color: white;
            margin-top: 2rem;
        }
        /* Navigation styles */
        nav {
            display: flex;
            align-items: center;
        }
        
        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1>@yield('title', 'Task Scheduler')</h1>
        <nav>
            @auth
                <div style="display: flex; align-items: center; gap: 1.5rem;">
                    @if(auth()->user()->isAdmin())
                        {{-- Admin Navigation --}}
                        <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                    @else
                        {{-- User Navigation --}}
                        <a href="{{ route('home') }}" class="nav-link">Tasks</a>
                    @endif
                    
            <form method="POST" action="{{ auth()->user()->isAdmin() ? route('admin.logout') : route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; color:white; cursor:pointer; font-weight:600; padding: 0.5rem 1rem;">Logout</button>
            </form>
                </div>
            @else
                <div>
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ url('/sign-up') }}" class="nav-link">Sign Up</a>
                </div>
            @endauth

        </nav>
    </header>

    <main>
        {{-- Flash messages --}}
        @if (session('success'))
            <div style="background:#d1fae5;border:1px solid #10b981;padding:0.75rem;border-radius:0.375rem;margin-bottom:1rem;color:#065f46;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background:#fee2e2;border:1px solid #ef4444;padding:0.75rem;border-radius:0.375rem;margin-bottom:1rem;color:#991b1b;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fef3c7;border:1px solid #f59e0b;padding:0.75rem;border-radius:0.375rem;margin-bottom:1rem;color:#78350f;">
                <ul style="margin:0;padding-left:1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @hasSection('content')
            {{-- Render legacy full-content sections when present (keeps backward compatibility) --}}
            @yield('content')
        @else
            <h2 class="page-title">@yield('page')</h2>
            
            <div class="add-button-container">
                @yield('addbtn')
            </div>

            @yield('table')
            @yield('content')
        @endif
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Task Scheduler. All rights reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>
