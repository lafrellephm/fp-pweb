<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Organisasi PWEB') }} — @yield('title', 'Dashboard')</title>

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-bg: #1A2744;
            --sidebar-text-active: #FFFFFF;
            --sidebar-text-idle: #A8B5C8;
            --sidebar-hover-bg: rgba(255, 255, 255, 0.08);
            --sidebar-accent: #066FD1;
            --page-bg: #F8FAFC;
            --card-bg: #FFFFFF;
            --primary-blue: #066FD1;
            --text-primary: #4E5967;
            --text-secondary: #6A7380;
            --border-color: rgba(1, 61, 209, 0.12);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--page-bg);
            margin: 0;
            padding: 0;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand-icon svg {
            width: 20px;
            height: 20px;
            color: #fff;
        }

        .sidebar-brand-text {
            font-size: 16px;
            font-weight: 700;
            color: #FFFFFF;
            line-height: 1.3;
        }

        .sidebar-brand-text small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: var(--sidebar-text-idle);
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0;
        }

        .sidebar-nav-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--sidebar-text-idle);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 20px 8px 20px;
            margin-top: 8px;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: var(--sidebar-text-idle);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            border-left: 3px solid transparent;
            transition: all 0.15s ease;
            margin: 1px 0;
        }

        .sidebar-nav-item:hover {
            background-color: var(--sidebar-hover-bg);
            color: var(--sidebar-text-active);
        }

        .sidebar-nav-item.active {
            color: var(--sidebar-text-active);
            background-color: var(--sidebar-hover-bg);
            border-left-color: var(--sidebar-accent);
            font-weight: 500;
        }

        .sidebar-nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .sidebar-nav-item.active svg {
            opacity: 1;
        }

        .sidebar-sub-item {
            padding-left: 54px;
            font-size: 13px;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* ── Main content ── */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ── */
        .top-navbar {
            height: 64px;
            background: var(--card-bg);
            border-bottom: 1px solid #E0E3E8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-page-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .navbar-notification {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-primary);
            transition: background 0.15s ease;
        }

        .navbar-notification:hover {
            background: rgba(6, 111, 209, 0.1);
        }

        .navbar-notification svg {
            width: 20px;
            height: 20px;
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #EF4444;
            border-radius: 50%;
            border: 2px solid var(--card-bg);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary-blue);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .navbar-user-info {
            display: flex;
            flex-direction: column;
        }

        .navbar-user-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .navbar-user-role {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: capitalize;
        }

        .navbar-divider {
            width: 1px;
            height: 24px;
            background: #E0E3E8;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-logout:hover {
            background: #FEE2E2;
            color: #DC2626;
            border-color: #FECACA;
        }

        .btn-logout svg {
            width: 16px;
            height: 16px;
        }

        /* ── Content area ── */
        .content-wrapper {
            flex: 1;
            padding: 32px;
        }

        /* ── Mobile sidebar toggle ── */
        .sidebar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-primary);
            border-radius: 6px;
        }

        .sidebar-toggle:hover {
            background: rgba(6, 111, 209, 0.1);
        }

        .sidebar-toggle svg {
            width: 20px;
            height: 20px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* ── Responsive ── */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: flex;
            }

            .content-wrapper {
                padding: 20px;
            }
        }

        @media (max-width: 767px) {
            .top-navbar {
                padding: 0 16px;
            }

            .content-wrapper {
                padding: 16px;
            }

            .navbar-user-info {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="/" class="sidebar-brand-logo">
                <div class="sidebar-brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="sidebar-brand-text">
                    Organisasi PWEB
                    <small>Letter Management</small>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            @yield('sidebar')
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <div class="navbar-left">
                <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="navbar-page-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="navbar-right">
                <!-- Notification Bell -->
                <button class="navbar-notification" title="Notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="notification-badge"></span>
                </button>

                <div class="navbar-divider"></div>

                <!-- User Info -->
                <div class="navbar-user">
                    <div class="navbar-user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="navbar-user-info">
                        <span class="navbar-user-name">{{ auth()->user()->name ?? 'User' }}</span>
                        <span class="navbar-user-role">{{ auth()->user()->role ?? 'user' }}</span>
                    </div>
                </div>

                <div class="navbar-divider"></div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>

    @stack('scripts')
</body>
</html>
