<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Task Scheduler')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Professional Header */
        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .nav-center {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo::before {
            content: '📅';
            font-size: 1.8rem;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: white;
            border-radius: 1px;
        }

        .nav-link.no-underline.active::after {
            display: none;
        }

        .auth-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-logout {
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-logout:hover {
            background: rgba(220, 38, 38, 0.3);
            transform: translateY(-1px);
        }

        /* Main Content */
        main {
            flex: 1;
            padding-top: 70px;
            min-height: calc(100vh - 70px);
        }

        /* Professional Footer */
        .main-footer {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: rgba(255, 255, 255, 0.9);
            padding: 2rem 0;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-copyright {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            text-align: center;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header-container {
                padding: 0 1rem;
                height: 60px;
            }

            .logo {
                font-size: 1.25rem;
            }

            .nav-menu {
                gap: 1rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }

            main {
                padding-top: 60px;
            }

            .footer-container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 480px) {
            .nav-menu {
                flex-direction: column;
                gap: 0.5rem;
            }

            .auth-section {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
    @stack('styles')
    @stack('navbar-override')
</head>
<body>
    <!-- Professional Header -->
    <header class="main-header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="logo">Task Scheduler</a>

            <div class="nav-center">
                <nav>
                    <ul class="nav-menu">
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/account_sync') }}" class="nav-link {{ Request::is('account_sync*') ? 'active' : '' }}">Account Sync</a>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>

            <div class="auth-section">
                <a href="{{ url('/') }}" class="nav-link no-underline {{ Request::is('/') ? 'active' : '' }}">Home</a>
                @guest
                    <a href="{{ route('login') }}" class="btn-primary">Login</a>
                    <a href="{{ url('/sign-up') }}" class="btn-primary">Sign Up</a>
                @else
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Professional Footer -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-copyright">
                &copy; {{ date('Y') }} Task Scheduler. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
