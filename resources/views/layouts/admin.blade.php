<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=3" type="image/png">
    <title>@yield('title', 'SmartCal Admin')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #10b981;
            --white: #ffffff;
            --gray-light: #64748b;
            --card-border: #e2e8f0;
            --card-bg: #ffffff;
        }
        body { background: #fbfbfb; color: #1e293b; font-family: 'Outfit', sans-serif; overflow-x: hidden; margin: 0; padding: 0; }
        /* Layout */
        .app-layout { display: flex; min-height: 100vh; }
        /* Sidebar */
        .sidebar { width: 260px; background: #ffffff; border-right: 1px solid #e2e8f0; color: #0f172a; display: flex; flex-direction: column; flex-shrink: 0; position: fixed; height: 100vh; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; z-index: 100; box-shadow: 2px 0 10px rgba(0,0,0,0.02); }
        .sidebar::-webkit-scrollbar { display: none; }
        .sidebar-brand { padding: 1.5rem 1rem; font-size: 1.6rem; font-family: 'Outfit'; font-weight: 800; display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #e2e8f0; }
        .sidebar-brand-text { display: flex; align-items: center; gap: 0.3rem; color: #0f172a; text-decoration: none; letter-spacing: -1px;}
        .sidebar-brand i.fa-leaf { color: #10b981; font-size: 1.4rem; }
        .sidebar-brand-text span { color: #10b981; }
        .admin-badge {
            font-size: 0.65rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 0.2rem 0.6rem; border-radius: 4px; letter-spacing: 2px; font-weight: 800; margin-left: 0.5rem; vertical-align: middle;
        }
        .sidebar-nav { padding: 1.5rem 0; flex: 1; display: flex; flex-direction: column; gap: 0.2rem; }
        .sidebar-link { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; color: #64748b; text-decoration: none; font-weight: 600; font-size: 1.05rem; transition: 0.2s; border-right: 4px solid transparent; }
        .sidebar-link:hover { background: #f8fafc; color: #10b981; }
        .sidebar-link.active { color: #10b981; border-right: 4px solid #10b981; background: rgba(16, 185, 129, 0.05); font-weight: 700; }
        .sidebar-link-left { display: flex; align-items: center; gap: 1rem; }
        .sidebar-link i.icon { font-size: 1.2rem; width: 24px; text-align: center; color: #94a3b8; transition: 0.2s;}
        .sidebar-link.active i.icon { color: #10b981 !important; }
        .sidebar-link:hover i.icon { color: #10b981; }
        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; }
        .dashboard-container { padding: 1.5rem 2rem; max-width: 1400px; margin: 0 auto; width: 100%; box-sizing: border-box; }
        .btn { padding: 0.8rem 2rem; border-radius: 50px; font-weight: 700; font-family: 'Outfit'; font-size: 0.95rem; cursor: pointer; text-decoration: none; display: inline-flex; justify-content: center; align-items: center; transition: 0.3s; border: none; letter-spacing: 1px; text-transform: uppercase;}
        .btn-outline { border: 2px solid #10b981; color: #10b981; background: transparent; }
        .btn-outline:hover { background: #10b981; color: #fff; transform: translateY(-2px); }
        .masonry-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;}
        .card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); padding: 1.5rem; border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; }
        .card-header h3 { margin: 0; font-size: 1.1rem; color: #0f172a; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;}
        .card-header h3 i { color: #10b981; font-size: 1.2rem; }
        .stat-box { display: flex; align-items: center; gap: 1.2rem; padding: 1.5rem; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.02); transition: 0.3s; position: relative; overflow: hidden; }
        .stat-box:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
        .stat-box::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: #0f172a; border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
        .stat-box.green::before { background: #10b981; }
        .stat-box.blue::before { background: #38bdf8; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; background: #f8fafc; color: #0f172a; display: flex; justify-content: center; align-items: center; font-size: 1.2rem; }
        .stat-box.green .stat-icon { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .stat-box.blue .stat-icon { background: rgba(56, 189, 248, 0.1); color: #38bdf8; }
        .stat-content { flex: 1; }
        .stat-label { margin-bottom: 0.2rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; }
        .stat-value { font-size: 1.8rem; margin-top: 0; color: #0f172a; font-weight: 800; line-height: 1; display: flex; align-items: baseline; gap: 0.5rem;}
        .stat-value span { font-size: 0.8rem; color: #94a3b8; letter-spacing: 1px; font-weight: 700; text-transform: uppercase;}
        .table-wrapper { overflow-x: auto; margin-top: 1rem; }
        .admin-table { width: 100%; border-collapse: collapse; text-align: left; }
        .admin-table th { padding: 1rem; border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;}
        .admin-table td { padding: 1.2rem 1rem; border-bottom: 1px solid #e2e8f0; color: #334155; font-weight: 600; font-size: 0.95rem; }
        .admin-table tr:hover td { background: #f8fafc; }
        .page-header { background: #fff; padding: 2rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .page-title h1 { font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.3rem 0; letter-spacing: -1px; }
        .page-title p { color: #64748b; margin: 0; font-size: 0.95rem; }
        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: static; }
            .main-content { margin-left: 0; }
        }
        .form-control { color: #0f172a !important; }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-text">
                    <i class="fas fa-leaf"></i> <span>Smart</span>Cal <span class="admin-badge">ADMIN</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-chart-pie icon"></i> <span>Overview</span></div>
                </a>
                <a href="{{ route('admin.foods') }}" class="sidebar-link {{ request()->routeIs('admin.foods') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-apple-alt icon"></i> <span>Food Database</span></div>
                </a>
                <a href="{{ route('admin.food.add.show') }}" class="sidebar-link {{ request()->routeIs('admin.food.add.show') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-plus-circle icon"></i> <span>Add New Food</span></div>
                </a>
                <a href="{{ route('admin.exercises') }}" class="sidebar-link {{ request()->routeIs('admin.exercises') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-dumbbell icon"></i> <span>Exercise Database</span></div>
                </a>
                <a href="{{ route('admin.exercise.add.show') }}" class="sidebar-link {{ request()->routeIs('admin.exercise.add.show') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-plus-circle icon"></i> <span>Add New Exercise</span></div>
                </a>
                <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users', 'admin.user.logs') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-users icon"></i> <span>Member Directory</span></div>
                </a>
                <a href="{{ route('admin.reviews') }}" class="sidebar-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                    <div class="sidebar-link-left"><i class="fas fa-star icon"></i> <span>Member Reviews</span></div>
                </a>
                <a href="{{ route('logout') }}" class="sidebar-link" style="margin-top: 2rem;">
                    <div class="sidebar-link-left"><i class="fas fa-sign-out-alt icon"></i> <span>Sign Out</span></div>
                </a>
            </nav>
        </aside>
        <main class="main-content">
            <div class="dashboard-container">
                @if(session('message'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid var(--primary); color: var(--primary); padding: 1.2rem; margin-bottom: 2rem; border-radius: 12px; font-weight: 700; text-transform: uppercase; text-align: center;">
                        {{ session('message') }}
                    </div>
                @endif
                @yield('admin_content')
            </div>
        </main>
    </div>
</body>
</html>
