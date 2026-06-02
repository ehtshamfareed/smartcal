<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SmartCal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #fbfbfb; color: #1e293b; font-family: 'Outfit', sans-serif; overflow-x: hidden; }
        
        /* Layout */
        .app-layout { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #ffffff; border-right: 1px solid #e2e8f0; color: #0f172a; display: flex; flex-direction: column; flex-shrink: 0; position: fixed; height: 100vh; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; }
        .sidebar::-webkit-scrollbar { display: none; }
        .sidebar-brand { padding: 1.5rem 2rem; font-size: 1.8rem; font-family: 'Outfit'; font-weight: 800; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; }
        .sidebar-brand-text { display: flex; align-items: center; gap: 0.5rem; color: #0f172a; text-decoration: none; letter-spacing: -1px;}
        .sidebar-brand i.fa-leaf { color: #10b981; }
        .sidebar-brand-text span { color: #10b981; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .sidebar-link { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; color: #475569; text-decoration: none; font-weight: 600; font-size: 1.05rem; transition: 0.2s; }
        .sidebar-link:hover { background: #f8fafc; color: #10b981; }
        .sidebar-link.active { color: #10b981; border-left: 4px solid #10b981; padding-left: calc(2rem - 4px); background: rgba(16, 185, 129, 0.05); }
        .sidebar-link-left { display: flex; align-items: center; gap: 1rem; }
        .sidebar-link i.icon { font-size: 1.2rem; width: 24px; text-align: center; color: #94a3b8; }
        .sidebar-link.active i.icon { color: #10b981 !important; }
        .sidebar-link:hover i.icon { color: #10b981; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; }
        .dashboard-container { padding: 1.5rem 2rem; max-width: 1400px; margin: 0 auto; width: 100%; }

        /* Quick Add Bar */
        .quick-add-bar { display: flex; align-items: center; gap: 1rem; background: #fff; padding: 0.8rem 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 1.5rem; border: 1px solid #e2e8f0; }
        .quick-add-title { font-weight: 800; color: #0f172a; font-size: 1rem; margin-right: auto; }
        .quick-add-btn { display: flex; align-items: center; gap: 0.5rem; color: #475569; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s; cursor: pointer; background: none; border: none; padding: 0;}
        .quick-add-btn:hover { color: #10b981; transform: translateY(-2px);}
        .quick-add-btn img { width: 20px; height: 20px; }

        /* Masonry Grid */
        .masonry-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; }
        .card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); padding: 1.5rem; border: 1px solid #f1f5f9; display: flex; flex-direction: column; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; }
        .card-header h3 { margin: 0; font-size: 1.1rem; color: #0f172a; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;}
        .card-header h3 i { color: #10b981; font-size: 1.2rem; }
        
        /* Specific Cards */
        .premium-card { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none;}
        .premium-card h3 { color: white; border-bottom-color: rgba(255,255,255,0.2); }
        .premium-card .card-header { border-bottom-color: rgba(255,255,255,0.2); }
        .premium-card p { color: rgba(255,255,255,0.9); }
        .premium-btn { background: #0f172a; color: white; padding: 0.6rem 1.5rem; border-radius: 50px; font-weight: 700; font-size: 0.8rem; border: none; cursor: pointer; transition: 0.3s; margin-top: 1rem; text-transform: uppercase; letter-spacing: 1px;}
        .premium-btn:hover { background: #fff; color: #0f172a; }

        /* Energy Stats */
        .energy-stats { display: flex; justify-content: space-between; text-align: center; margin-bottom: 1.5rem; }
        .e-stat { flex: 1; }
        .e-val { font-size: 1.8rem; font-weight: 800; color: #0f172a; }
        .e-label { font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;}
        .e-val.green { color: #10b981; }
        .e-val.orange { color: #f97316; }

        .progress-bar { width: 100%; height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden; position: relative;}
        .progress-fill { height: 100%; background: #10b981; border-radius: 10px; transition: width 1s ease-in-out;}
        .progress-fill.over { background: #f43f5e; }

        /* List Items */
        .log-item { display: flex; justify-content: space-between; align-items: center; padding: 0.8rem 0; border-bottom: 1px dashed #e2e8f0; }
        .log-item:last-child { border-bottom: none; }
        .log-title { font-weight: 700; color: #0f172a; font-size: 0.95rem;}
        .log-meta { font-size: 0.75rem; color: #94a3b8; font-weight: 600; text-transform: uppercase; }
        .log-val { font-weight: 800; font-size: 1.1rem; color: #10b981; }
        .log-val.burn { color: #f97316; }
        
        .badge { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.2rem 0.6rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-left: 0.5rem;}
        
        .delete-btn { background: none; border: none; color: #cbd5e1; cursor: pointer; font-size: 1.2rem; transition: 0.2s; padding: 0; margin-left: 1rem;}
        .delete-btn:hover { color: #ef4444; }

        /* Modal Styles */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 1000; display: none; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s ease; }
        .modal-overlay.active { display: flex; opacity: 1; }
        .food-modal { background: #fff; width: 90%; max-width: 900px; height: 85vh; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); display: flex; flex-direction: column; overflow: hidden; transform: translateY(20px); transition: transform 0.3s ease; }
        .modal-overlay.active .food-modal { transform: translateY(0); }
        
        .modal-header { padding: 1.5rem 2rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .modal-header h2 { font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0; }
        .close-modal { background: none; border: none; color: #64748b; font-size: 1.5rem; cursor: pointer; transition: 0.2s; }
        .close-modal:hover { color: #f43f5e; transform: scale(1.1); }

        .modal-search-bar { padding: 1rem 2rem; border-bottom: 1px solid #e2e8f0; display: flex; gap: 1rem; align-items: center; background: #f8fafc; }
        .search-input-wrapper { flex: 1; display: flex; align-items: center; background: #fff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 0.5rem 1rem; }
        .search-input-wrapper i { color: #94a3b8; font-size: 1.2rem; margin-right: 0.8rem; }
        .search-input { border: none; outline: none; width: 100%; font-family: 'Outfit'; font-size: 1rem; color: #0f172a; }
        .filter-btn { background: #fff; border: 1px solid #cbd5e1; padding: 0.6rem 1rem; border-radius: 8px; color: #f59e0b; cursor: pointer; transition: 0.2s;}
        .search-btn { background: none; border: none; color: #0f172a; font-family: 'Outfit'; font-weight: 700; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; padding: 0.5rem 1rem;}
        .search-btn:hover { color: #10b981; }

        .modal-tabs { padding: 0 2rem; border-bottom: 1px solid #e2e8f0; display: flex; gap: 2rem; overflow-x: auto; background: #fff; justify-content: space-between; align-items: center;}
        .tabs-left { display: flex; gap: 2rem; }
        .modal-tab { padding: 1rem 0; color: #64748b; font-family: 'Outfit'; font-weight: 600; font-size: 0.95rem; cursor: pointer; border-bottom: 2px solid transparent; transition: 0.2s; white-space: nowrap; }
        .modal-tab:hover { color: #10b981; }
        .modal-tab.active { color: #0f172a; border-bottom-color: #f59e0b; }
        
        .add-custom-btn { background: none; border: none; color: #10b981; font-weight: 700; font-family: 'Outfit'; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; }
        .add-custom-btn i { font-size: 1.2rem; }

        .modal-body { flex: 1; overflow-y: auto; padding: 0; background: #fff; }
        
        /* Grid Cards for Exercise Modal */
        .exercise-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.5rem; padding: 2rem; }
        .exercise-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 2rem 1rem; text-align: center; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .exercise-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); border-color: #cbd5e1; }
        .exercise-card i { font-size: 2.5rem; color: #94a3b8; margin-bottom: 1rem; transition: 0.3s; }
        .exercise-card:hover i { color: #f97316; }
        .exercise-card-title { font-weight: 600; color: #334155; font-size: 1rem; line-height: 1.3;}

        .food-table { width: 100%; border-collapse: collapse; }
        .food-table th { background: #f1f5f9; padding: 0.8rem 2rem; text-align: left; font-size: 0.85rem; color: #475569; font-weight: 700; font-family: 'Outfit'; position: sticky; top: 0; }
        .food-table td { padding: 1rem 2rem; border-bottom: 1px solid #f1f5f9; font-family: 'Outfit'; font-size: 0.95rem; color: #334155; transition: 0.2s;}
        .food-row { cursor: pointer; }
        .food-row:hover td { background: #f8fafc; color: #0f172a; }
        .food-row.selected td { background: rgba(16, 185, 129, 0.05); border-bottom-color: rgba(16, 185, 129, 0.2); }
        .source-badge { background: #fef2f2; color: #ef4444; font-size: 0.75rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; margin-right: 8px;}

        .modal-footer { padding: 1.5rem 2rem; background: #fff; border-top: 1px solid #e2e8f0; display: none; align-items: center; justify-content: space-between; box-shadow: 0 -10px 20px rgba(0,0,0,0.02);}
        .modal-footer.active { display: flex; }
        .selected-food-info { font-family: 'Outfit'; }
        .selected-name { font-weight: 800; font-size: 1.1rem; color: #0f172a; margin-bottom: 0.2rem; }
        .selected-cals { font-size: 0.9rem; color: #10b981; font-weight: 700; }
        .add-food-form { display: flex; gap: 1rem; align-items: center; }
        .meal-select { padding: 0.8rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: 'Outfit'; outline: none; }
        .submit-food-btn { background: #10b981; color: #fff; border: none; padding: 0.8rem 2rem; border-radius: 8px; font-family: 'Outfit'; font-weight: 800; cursor: pointer; transition: 0.2s; text-transform: uppercase; letter-spacing: 1px;}
        .submit-food-btn:hover { background: #059669; transform: translateY(-2px); }

        /* Sidebar Submenu */
        .sidebar-submenu { display: none; background: #f8fafc; }
        .sidebar-submenu.active { display: block; }
        .submenu-link { display: block; padding: 0.8rem 2rem 0.8rem 4rem; color: #64748b; text-decoration: none; font-size: 0.95rem; font-weight: 600; transition: 0.2s; }
        .submenu-link:hover, .submenu-link.active { color: #10b981; background: #fff; border-left: 4px solid #10b981; padding-left: calc(4rem - 4px); }

        /* Trends View */
        .trends-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; }
        .trends-title-block h2 { font-size: 1.5rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 0.5rem; margin: 0 0 0.5rem 0;}
        .trends-title-block p { color: #64748b; font-size: 0.95rem; margin: 0; }
        .manage-charts-btn { color: #10b981; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; background: none; border: none; cursor: pointer; letter-spacing: 1px; }

        .gold-banner { background: #fef08a; border-radius: 12px; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border: 1px solid #fde047; }
        .gold-banner-left { display: flex; align-items: center; gap: 1rem; }
        .gold-icon { background: #0f172a; color: #10b981; width: 45px; height: 45px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.5rem; }
        .gold-text h3 { margin: 0 0 0.3rem 0; font-size: 1.1rem; color: #0f172a; font-weight: 800; }
        .gold-text p { margin: 0; font-size: 0.9rem; color: #475569; }
        .gold-upgrade-btn { background: #0f172a; color: white; padding: 0.8rem 1.5rem; border-radius: 8px; border: none; font-weight: 800; font-size: 0.85rem; cursor: pointer; text-transform: uppercase; transition: 0.2s; }
        .gold-upgrade-btn:hover { background: #1e293b; }

        .chart-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .chart-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1.5rem; }
        .chart-title { font-weight: 800; color: #0f172a; font-size: 1.1rem; margin-bottom: 0.3rem; }
        .chart-date { color: #64748b; font-size: 0.85rem; }
        .chart-controls { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;}
        .chart-select { border: 1px solid #cbd5e1; border-radius: 4px; padding: 0.5rem 1rem; font-family: 'Outfit'; color: #475569; font-size: 0.85rem; outline: none; background: white; cursor: pointer;}
        .chart-options-btn { background: none; border: none; color: #10b981; font-size: 1.2rem; cursor: pointer; padding: 0 0.5rem; }
        
        .chart-wrapper { height: 350px; width: 100%; position: relative; }

        /* Nutrition Report UI */
        .nutrition-report-container { background: #fff; padding: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .nr-header { display: flex; gap: 2rem; justify-content: space-between; overflow-x: auto; padding-bottom: 2rem; border-bottom: 1px solid #f1f5f9; margin-bottom: 2rem; }
        .nr-circle-item { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; min-width: 60px; }
        .nr-circle { width: 50px; height: 50px; border-radius: 50%; border: 4px solid #f1f5f9; display: flex; justify-content: center; align-items: center; font-size: 0.85rem; font-weight: 800; color: #0f172a; position: relative; }
        .nr-circle.filled { border-color: #10b981; }
        .nr-label { font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; }

        .nr-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .nr-section { margin-bottom: 2rem; }
        .nr-section-title { background: #f1f5f9; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 800; color: #334155; font-size: 0.9rem; margin-bottom: 1rem; }
        .nr-row { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 1rem; font-size: 0.85rem; border-bottom: 1px solid #f8fafc; }
        .nr-row:last-child { border-bottom: none; }
        .nr-name { color: #475569; font-weight: 500; flex: 1; }
        .nr-val { font-weight: 700; color: #0f172a; width: 60px; text-align: right; }
        .nr-bar-container { width: 100px; height: 6px; background: #f1f5f9; border-radius: 4px; margin: 0 1rem; overflow: hidden;}
        .nr-bar-fill { height: 100%; background: #cbd5e1; border-radius: 4px; }
        .nr-bar-fill.active { background: #38bdf8; }
        .nr-pct { font-weight: 700; color: #64748b; width: 30px; text-align: right; font-size: 0.8rem; }

        @media (max-width: 900px) {
            .nr-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .app-layout { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: static; }
            .main-content { margin-left: 0; }
            .quick-add-bar { flex-wrap: wrap; }
            .quick-add-title { border: none; padding: 0; width: 100%; margin-bottom: 0.5rem; }
            .masonry-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('index') }}" class="sidebar-brand-text">
                    <i class="fas fa-leaf"></i> <span>Smart</span>Cal
                </a>
                <i class="fas fa-bars" style="cursor:pointer; color:#94a3b8; font-size:1.2rem;"></i>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#" class="sidebar-link active" id="menuDiary" onclick="switchView('diary'); return false;">
                    <div class="sidebar-link-left"><i class="fas fa-list-ul icon"></i> <span>Diary</span></div>
                </a>
                
                <a href="#" class="sidebar-link" id="menuTrends" onclick="toggleSubmenu('trendsSubmenu'); switchView('trends'); return false;">
                    <div class="sidebar-link-left"><i class="fas fa-chart-bar icon"></i> <span>Trends</span></div>
                    <i class="fas fa-chevron-down" style="font-size:0.8rem;" id="trendsChevron"></i>
                </a>
                <div class="sidebar-submenu" id="trendsSubmenu">
                    <a href="#" class="submenu-link active">Charts</a>
                    <a href="#" class="submenu-link">Nutrition Report</a>
                    <a href="#" class="submenu-link" onclick="window.print(); return false;"><i class="fas fa-file-pdf" style="margin-right:0.3rem;"></i> Export as PDF</a>
                </div>

                <a href="#" class="sidebar-link">
                    <div class="sidebar-link-left"><i class="fas fa-apple-alt icon"></i> Foods</div>
                    <i class="fas fa-chevron-down" style="font-size:0.8rem;"></i>
                </a>
                <a href="{{ route('profile') }}" class="sidebar-link">
                    <div class="sidebar-link-left"><i class="fas fa-user-circle icon"></i> <span>Profile</span></div>
                </a>
                
                <a href="#" class="sidebar-link" onclick="toggleSubmenu('aboutSubmenu'); return false;">
                    <div class="sidebar-link-left"><i class="fas fa-info-circle icon"></i> <span>About</span></div>
                    <i class="fas fa-chevron-down" style="font-size:0.8rem;" id="aboutChevron"></i>
                </a>
                <div class="sidebar-submenu" id="aboutSubmenu">
                    <a href="{{ route('privacy.policy') }}" class="submenu-link">Privacy</a>
                    <a href="{{ route('terms.service') }}" class="submenu-link">Terms of Service</a>
                    <a href="{{ route('blogs') }}" class="submenu-link">Blog</a>
                </div>

                <a href="{{ route('logout') }}" class="sidebar-link" style="margin-top: 2rem;">
                    <div class="sidebar-link-left"><i class="fas fa-sign-out-alt icon"></i> <span>Sign Out</span></div>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="dashboard-container">
            
            <!-- DIARY VIEW -->
            <div id="diaryView">
        
        <div style="margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; font-family: 'Outfit'; margin: 0;">Hello, {{ Auth::user()->name }}</h1>
                <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.2rem;">Welcome back. Let's hit your goals today!</p>
            </div>
        </div>

        <!-- Quick Add Bar -->
        <div class="quick-add-bar">
            <div class="quick-add-title">Quick Add to Diary</div>
            <button onclick="openFoodModal()" class="quick-add-btn">
                <i class="fas fa-apple-alt" style="color: #ef4444; font-size: 1.2rem;"></i> FOOD
            </button>
            <button onclick="openWorkoutModal()" class="quick-add-btn">
                <i class="fas fa-running" style="color: #f97316; font-size: 1.2rem;"></i> EXERCISE
            </button>
            <button type="button" class="quick-add-btn" id="quickWaterBtn" onclick="addQuickWater()">
                <i class="fas fa-tint" style="color: #0ea5e9; font-size: 1.2rem;"></i> WATER
            </button>
        </div>

        <div class="masonry-grid">
            
            <!-- Energy Summary Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt" style="color: #f59e0b;"></i> Energy Summary</h3>
                    <span class="badge" style="background: #f1f5f9; color: #64748b;">{{ $recommended_calories }} KCAL GOAL</span>
                </div>
                
                <div class="energy-stats">
                    <div class="e-stat">
                        <div class="e-val green">{{ $consumed_calories }}</div>
                        <div class="e-label">Consumed</div>
                    </div>
                    <div class="e-stat">
                        <div class="e-val orange">{{ $burned_calories }}</div>
                        <div class="e-label">Burned</div>
                    </div>
                    <div class="e-stat">
                        <div class="e-val {{ $remaining < 0 ? 'orange' : '' }}">{{ abs($remaining) }}</div>
                        <div class="e-label">{{ $remaining < 0 ? 'Over' : 'Remaining' }}</div>
                    </div>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill {{ $remaining < 0 ? 'over' : '' }}" style="width: {{ min(100, ($net_calories / max(1, $recommended_calories)) * 100) }}%"></div>
                </div>
                <div style="text-align: center; margin-top: 0.8rem; font-size: 0.8rem; font-weight: 700; color: #94a3b8;">
                    {{ round(($net_calories/max(1, $recommended_calories))*100) }}% OF DAILY LIMIT
                </div>
            </div>

            <!-- Profile Overview Card -->
            <div class="card premium-card">
                <div class="card-header">
                    <h3><i class="fas fa-user-circle" style="color: #fff;"></i> My Profile</h3>
                    <span style="font-size: 0.8rem; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 4px;">{{ ucfirst($user->weight_goal) }} Phase</span>
                </div>
                <p style="font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.5;">
                    Your metabolic targets are calibrated based on your profile:<br>
                    <strong>{{ $user->age }} yrs &bull; {{ ucfirst($user->gender) }} &bull; {{ $user->weight_kg }}kg &bull; {{ $user->height_cm }}cm</strong>
                </p>
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('profile') }}" style="flex: 1;"><button class="premium-btn" style="width: 100%;">UPDATE PROFILE</button></a>
                    <button class="premium-btn" style="flex: 1; background: #bae6fd; color: #0f172a;" onclick="openReviewModal()"><i class="fas fa-star" style="color: #f59e0b; margin-right: 0.5rem;"></i> LEAVE A REVIEW</button>
                </div>
            </div>

            <!-- Food Log Card -->
            <div class="card" style="grid-row: span 2;">
                <div class="card-header">
                    <h3><i class="fas fa-utensils"></i> Food Diary</h3>
                    <button onclick="openFoodModal()" style="color: #10b981; font-size: 1.2rem; background: none; border: none; cursor: pointer; padding: 0;"><i class="fas fa-plus-circle"></i></button>
                </div>
                
                @if($logs->isEmpty())
                    <div style="text-align: center; padding: 2rem 0; color: #94a3b8;">
                        <i class="fas fa-apple-alt" style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem; display: block;"></i>
                        <p style="font-weight: 600; font-size: 0.9rem;">No food logged yet.<br>Click the + icon to add fuel.</p>
                    </div>
                @else
                    <div>
                        @foreach($logs as $log)
                        <div class="log-item">
                            <div>
                                <div class="log-title">
                                    {{ $log->custom_food_name }}
                                    @if($log->foodItem)
                                        @if(Auth::user()->weight_goal == 'lose' && $log->foodItem->suitability == 'loss')
                                            <span style="font-size: 0.55rem; background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.15rem 0.4rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(16,185,129,0.3); vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-check"></i> Recommended</span>
                                        @elseif(Auth::user()->weight_goal == 'lose' && $log->foodItem->suitability == 'gain')
                                            <span style="font-size: 0.55rem; background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.15rem 0.4rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(239,68,68,0.3); vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-exclamation-triangle"></i> Not Recommended</span>
                                        @elseif(Auth::user()->weight_goal == 'gain' && $log->foodItem->suitability == 'gain')
                                            <span style="font-size: 0.55rem; background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.15rem 0.4rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(16,185,129,0.3); vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-check"></i> Bulking</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="log-meta">{{ ucfirst($log->meal_type) }}</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="log-val">{{ $log->calories }}</div>
                                <form method="POST" action="{{ route('food.delete', $log->id) }}">
                                    @csrf
                                    <button type="submit" class="delete-btn" title="Delete"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Exercise Log Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-fire" style="color: #f97316;"></i> Exercise Log</h3>
                    <button onclick="openWorkoutModal()" style="color: #f97316; font-size: 1.2rem; background: none; border: none; cursor: pointer; padding: 0;"><i class="fas fa-plus-circle"></i></button>
                </div>
                
                @if($workouts->isEmpty())
                    <div style="text-align: center; padding: 1.5rem 0; color: #94a3b8;">
                        <p style="font-weight: 600; font-size: 0.9rem;">No workouts logged today.</p>
                    </div>
                @else
                    <div>
                        @foreach($workouts as $w)
                        <div class="log-item">
                            <div>
                                <div class="log-title">{{ $w->custom_exercise_name }}</div>
                                <div class="log-meta">{{ $w->duration_minutes }} MINS</div>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <div class="log-val burn">{{ $w->calories_burned }}</div>
                                <form method="POST" action="{{ route('workout.delete', $w->id) }}">
                                    @csrf
                                    <button type="submit" class="delete-btn" title="Delete"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Hydration Card New UI -->
            <div class="card" style="border:none; box-shadow:none; padding:1.5rem 0;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1rem;">
                    <h3 style="font-size:1.2rem; font-weight:800; color:#0f172a; margin:0; display:flex; align-items:center; gap:0.5rem;">Water <span style="font-size:0.9rem; font-weight:normal; color:#64748b;">{{ $water_glasses }} / 8 glasses</span></h3>
                    <i class="fas fa-chevron-up" style="color:#0f172a; cursor:pointer;"></i>
                </div>
                
                <div style="display:flex; gap:0.5rem; margin-bottom:1.5rem; flex-wrap: wrap;">
                    @for($i=1; $i<=8; $i++)
                        @if($i <= $water_glasses)
                            <!-- Filled Glass -->
                            <form method="POST" action="{{ route('dashboard.water') }}" style="margin:0;">
                                @csrf <input type="hidden" name="action" value="remove_water">
                                <button type="submit" style="background:none; border:2px solid #334155; border-radius:4px 4px 10px 10px; width:35px; height:45px; cursor:pointer; position:relative; overflow:hidden; padding:0; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; width:100%; height:80%; background:#bae6fd;"></div>
                                </button>
                            </form>
                        @elseif($i == $water_glasses + 1)
                            <!-- Next Empty Glass with + -->
                            <form method="POST" action="{{ route('dashboard.water') }}" style="margin:0;">
                                @csrf <input type="hidden" name="action" value="add_water">
                                <button type="submit" style="background:#e0f2fe; border:2px solid #334155; border-radius:4px 4px 10px 10px; width:35px; height:45px; cursor:pointer; position:relative; padding:0; display:flex; justify-content:center; align-items:center; opacity: 0.9;">
                                    <i class="fas fa-plus" style="color:#334155; font-size:0.9rem;"></i>
                                </button>
                            </form>
                        @else
                            <!-- Empty Glass -->
                            <div style="border:2px solid #334155; border-radius:4px 4px 10px 10px; width:35px; height:45px; opacity:0.4;"></div>
                        @endif
                    @endfor
                </div>

                <div id="waterAlertBox" style="background:#ccfbf1; padding:1rem; border-radius:8px; display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; color:#0f172a; font-size:0.9rem;">
                    <div>Water added here will contribute to your total water nutrient target.</div>
                    <i class="fas fa-times" style="cursor:pointer;" onclick="document.getElementById('waterAlertBox').style.display='none'"></i>
                </div>

                <div style="display:flex; justify-content:space-between; font-size:0.85rem; color:#0f172a; margin-bottom:0.5rem; font-family:'Outfit';">
                    <span style="font-weight:600;">Total Water - <span style="color:#64748b; font-weight:normal;">{{ $water_glasses }} / 8 glasses</span></span>
                    <span>{{ round(($water_glasses/8)*100) }}%</span>
                </div>
                <div class="progress-bar" style="height:12px; border-radius:6px; background:#f1f5f9;">
                    <div class="progress-fill" style="width: {{ min(100, ($water_glasses/8)*100) }}%; background:#38bdf8; border-radius:6px; transition: 0.5s;"></div>
                </div>
            </div>

            <!-- Analytics Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line" style="color: #8b5cf6;"></i> Trends</h3>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <div style="flex: 1; background: #f8fafc; padding: 1rem; border-radius: 12px; text-align: center; border: 1px solid #e2e8f0;">
                        <div style="font-size: 0.7rem; color: #64748b; font-weight: 800; text-transform: uppercase; margin-bottom: 0.5rem;">7-Day Avg</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: #0f172a;">{{ $avg_7_days }}</div>
                        <div style="font-size: 0.7rem; color: #94a3b8;">KCAL/DAY</div>
                    </div>
                    <div style="flex: 1; background: rgba(249, 115, 22, 0.05); padding: 1rem; border-radius: 12px; text-align: center; border: 1px solid rgba(249, 115, 22, 0.2);">
                        <div style="font-size: 0.7rem; color: #f97316; font-weight: 800; text-transform: uppercase; margin-bottom: 0.5rem;">Monthly Burn</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: #f97316;">{{ number_format($month_total_burn) }}</div>
                        <div style="font-size: 0.7rem; color: #f97316; opacity: 0.7;">KCAL OUT</div>
                    </div>
                </div>
            </div>

        </div>
        </div> <!-- End Diary View -->

        <!-- TRENDS VIEW -->
        <div id="trendsView" style="display: none;">
            <div class="trends-header">
                <div class="trends-title-block">
                    <h2>Charts <i class="far fa-question-circle" style="color: #94a3b8; font-size: 1.1rem; cursor: pointer;"></i></h2>
                    <p>Customize your charts to review and analyze the information you're most interested in.</p>
                </div>
                <button class="manage-charts-btn">MANAGE CHARTS</button>
            </div>

            <div class="gold-banner">
                <div class="gold-banner-left">
                    <div class="gold-icon"><i class="fas fa-chart-bar"></i></div>
                    <div class="gold-text">
                        <h3>Gain valuable insights with Gold!</h3>
                        <p>Chart the biometric and nutrient data that matters most to you.</p>
                    </div>
                </div>
                <button class="gold-upgrade-btn" onclick="openPremiumModal()">UPGRADE</button>
            </div>

            <div class="chart-card">
                <div class="chart-top">
                    <div>
                        <div class="chart-title">Energy Consumed (kcal)</div>
                        <div class="chart-date">Jun 1 - 2, 2026</div>
                    </div>
                    <div class="chart-controls">
                        <select class="chart-select">
                            <option>Last 3 weeks</option>
                        </select>
                        <select class="chart-select">
                            <option>All Days</option>
                        </select>
                        <span style="color: #cbd5e1; margin: 0 0.5rem; font-weight: 800;">...</span>
                        <select class="chart-select">
                            <option>Left Y-Axis Unit: kcal</option>
                        </select>
                    </div>
                </div>
                
                <div class="chart-wrapper">
                    <canvas id="energyChart"></canvas>
                </div>
            </div>

            <!-- Nutrition Report UI -->
            <div class="nutrition-report-container">
                
                <div class="nr-header">
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['fiber'] > 0 ? 'filled' : '' }}">{{ $micros['fiber'] > 0 ? '12%' : '0%' }}</div>
                        <div class="nr-label">Fiber</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['iron'] > 0 ? 'filled' : '' }}">{{ $micros['iron'] > 0 ? '4%' : '0%' }}</div>
                        <div class="nr-label">Iron</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['calcium'] > 0 ? 'filled' : '' }}">{{ $micros['calcium'] > 0 ? '8%' : '0%' }}</div>
                        <div class="nr-label">Calcium</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['vit_a'] > 0 ? 'filled' : '' }}">{{ $micros['vit_a'] > 0 ? '6%' : '0%' }}</div>
                        <div class="nr-label">Vit A</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['vit_c'] > 0 ? 'filled' : '' }}">{{ $micros['vit_c'] > 0 ? '3%' : '0%' }}</div>
                        <div class="nr-label">Vit C</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['vit_b12'] > 0 ? 'filled' : '' }}">{{ $micros['vit_b12'] > 0 ? '5%' : '0%' }}</div>
                        <div class="nr-label">Vit B12</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle">0%</div>
                        <div class="nr-label">Folate</div>
                    </div>
                    <div class="nr-circle-item">
                        <div class="nr-circle {{ $micros['potassium'] > 0 ? 'filled' : '' }}">{{ $micros['potassium'] > 0 ? '2%' : '0%' }}</div>
                        <div class="nr-label">Potassium</div>
                    </div>
                </div>

                <div class="nr-grid">
                    <div>
                        <div class="nr-section">
                            <div class="nr-section-title">General</div>
                            <div class="nr-row">
                                <div class="nr-name">Energy</div>
                                <div class="nr-val">{{ $consumed_calories }} kcal</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $consumed_calories > 0 ? 'active' : '' }}" style="width: {{ min(100, ($consumed_calories / max(1, $recommended_calories)) * 100) }}%;"></div></div>
                                <div class="nr-pct">{{ round(($consumed_calories / max(1, $recommended_calories)) * 100) }}%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Water</div>
                                <div class="nr-val">{{ $micros['water'] }} g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['water'] > 0 ? 'active' : '' }}" style="width: 2%;"></div></div>
                                <div class="nr-pct">2%</div>
                            </div>
                        </div>

                        <div class="nr-section">
                            <div class="nr-section-title">Carbohydrates</div>
                            <div class="nr-row">
                                <div class="nr-name">Carbs</div>
                                <div class="nr-val">{{ $carbs_g }} g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $carbs_g > 0 ? 'active' : '' }}" style="width: {{ min(100, ($carbs_g / 250) * 100) }}%;"></div></div>
                                <div class="nr-pct">{{ round(($carbs_g / 250) * 100) }}%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name" style="padding-left: 1rem;">Fiber</div>
                                <div class="nr-val">{{ $micros['fiber'] }} g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['fiber'] > 0 ? 'active' : '' }}" style="width: 12%;"></div></div>
                                <div class="nr-pct">12%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name" style="padding-left: 1rem;">Sugars</div>
                                <div class="nr-val">0.0 g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill"></div></div>
                                <div class="nr-pct">N/T</div>
                            </div>
                        </div>

                        <div class="nr-section">
                            <div class="nr-section-title">Lipids</div>
                            <div class="nr-row">
                                <div class="nr-name">Fat</div>
                                <div class="nr-val">{{ $fat_g }} g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $fat_g > 0 ? 'active' : '' }}" style="width: {{ min(100, ($fat_g / 60) * 100) }}%;"></div></div>
                                <div class="nr-pct">{{ round(($fat_g / 60) * 100) }}%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name" style="padding-left: 1rem;">Saturated</div>
                                <div class="nr-val">0.0 g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill"></div></div>
                                <div class="nr-pct">N/T</div>
                            </div>
                        </div>
                        
                        <div class="nr-section">
                            <div class="nr-section-title">Protein</div>
                            <div class="nr-row">
                                <div class="nr-name">Protein</div>
                                <div class="nr-val">{{ $protein_g }} g</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $protein_g > 0 ? 'active' : '' }}" style="width: {{ min(100, ($protein_g / 100) * 100) }}%;"></div></div>
                                <div class="nr-pct">{{ round(($protein_g / 100) * 100) }}%</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="nr-section">
                            <div class="nr-section-title">Vitamins</div>
                            <div class="nr-row">
                                <div class="nr-name">B12 (Cobalamin)</div>
                                <div class="nr-val">{{ $micros['vit_b12'] }} µg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['vit_b12'] > 0 ? 'active' : '' }}" style="width: 5%;"></div></div>
                                <div class="nr-pct">5%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Vitamin A</div>
                                <div class="nr-val">{{ $micros['vit_a'] }} µg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['vit_a'] > 0 ? 'active' : '' }}" style="width: 6%;"></div></div>
                                <div class="nr-pct">6%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Vitamin C</div>
                                <div class="nr-val">{{ $micros['vit_c'] }} mg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['vit_c'] > 0 ? 'active' : '' }}" style="width: 3%;"></div></div>
                                <div class="nr-pct">3%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Vitamin D</div>
                                <div class="nr-val">0.0 IU</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill"></div></div>
                                <div class="nr-pct">0%</div>
                            </div>
                        </div>

                        <div class="nr-section">
                            <div class="nr-section-title">Minerals</div>
                            <div class="nr-row">
                                <div class="nr-name">Calcium</div>
                                <div class="nr-val">{{ $micros['calcium'] }} mg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['calcium'] > 0 ? 'active' : '' }}" style="width: 8%;"></div></div>
                                <div class="nr-pct">8%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Iron</div>
                                <div class="nr-val">{{ $micros['iron'] }} mg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['iron'] > 0 ? 'active' : '' }}" style="width: 4%;"></div></div>
                                <div class="nr-pct">4%</div>
                            </div>
                            <div class="nr-row">
                                <div class="nr-name">Potassium</div>
                                <div class="nr-val">{{ $micros['potassium'] }} mg</div>
                                <div class="nr-bar-container"><div class="nr-bar-fill {{ $micros['potassium'] > 0 ? 'active' : '' }}" style="width: 2%;"></div></div>
                                <div class="nr-pct">2%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End Trends View -->

    </div>

    <!-- Add Food Modal Overlay -->
    <div class="modal-overlay" id="foodModalOverlay">
        <div class="food-modal">
            <div class="modal-header">
                <h2>Add Food to Diary</h2>
                <button class="close-modal" onclick="closeFoodModal()"><i class="fas fa-times"></i></button>
            </div>
            
            <div class="modal-search-bar">
                <div class="search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="foodSearchInput" class="search-input" placeholder="Search all foods & recipes..." onkeyup="filterFoods()">
                </div>
                <button class="filter-btn"><i class="fas fa-sliders-h"></i></button>
                <button class="search-btn">SEARCH</button>
            </div>

            <div class="modal-tabs">
                <div class="tabs-left" id="foodTabsContainer">
                    <div class="modal-tab active" onclick="switchFoodTab(this, 'all')" style="color: #0f172a; border-bottom-color: #10b981;">All</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'favorites')">Favorites</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'common')">Common Foods</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'beverages')">Beverages</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'supplements')">Supplements</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'brands')">Brands</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'restaurants')">Restaurants</div>
                    <div class="modal-tab" onclick="switchFoodTab(this, 'custom')">Custom</div>
                </div>
                <div class="modal-tab"><i class="far fa-question-circle"></i></div>
            </div>

            <div class="modal-body">
                <table class="food-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th style="text-align: right;">Calories</th>
                        </tr>
                    </thead>
                    <tbody id="foodTableBody">
                        @foreach($foods as $food)
                        <tr class="food-row" data-id="{{ $food->id }}" data-name="{{ $food->name }}" data-cals="{{ $food->calories }}" data-suitability="{{ $food->suitability }}" onclick="selectFood(this)">
                            <td>
                                {{ $food->name }}
                                @if(Auth::user()->weight_goal == 'lose' && $food->suitability == 'loss')
                                    <span style="font-size: 0.65rem; background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.2rem 0.5rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(16,185,129,0.3);"><i class="fas fa-check"></i> Recommended</span>
                                @elseif(Auth::user()->weight_goal == 'lose' && $food->suitability == 'gain')
                                    <span style="font-size: 0.65rem; background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.2rem 0.5rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(239,68,68,0.3);"><i class="fas fa-exclamation-triangle"></i> Not Recommended</span>
                                @elseif(Auth::user()->weight_goal == 'gain' && $food->suitability == 'gain')
                                    <span style="font-size: 0.65rem; background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.2rem 0.5rem; border-radius: 4px; margin-left: 0.5rem; border: 1px solid rgba(16,185,129,0.3);"><i class="fas fa-check"></i> Great for Bulking</span>
                                @endif
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #10b981;">
                                {{ $food->calories }} kcal
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer" id="modalFooter">
                <div class="selected-food-info">
                    <div class="selected-name" id="selectedFoodName">Select a food...</div>
                    <div class="selected-cals" id="selectedFoodCals">-- KCAL</div>
                </div>
                <form id="addFoodFormMain" class="add-food-form" method="POST" action="{{ route('food.add') }}">
                    @csrf
                    <input type="hidden" name="food_id" id="formFoodId">
                    <input type="hidden" name="custom_food_name" id="formFoodName">
                    <input type="hidden" name="calories" id="formFoodCals">
                    
                    <select name="meal_type" class="meal-select" required>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="snacks" selected>Snacks</option>
                    </select>
                    <button type="submit" class="submit-food-btn">ADD TO DIARY</button>
                </form>
            </div>
        </div>
    </div> <!-- Close foodModalOverlay -->

    <!-- Add Exercise Modal Overlay -->
    <div class="modal-overlay" id="workoutModalOverlay">
        <div class="food-modal">
            <div class="modal-header">
                <h2>Add Exercise</h2>
                <button class="close-modal" onclick="closeWorkoutModal()"><i class="fas fa-times"></i></button>
            </div>
            
            <div class="modal-search-bar">
                <div class="search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" placeholder="Search all exercises...">
                </div>
            </div>

            <div class="modal-tabs">
                <div class="tabs-left">
                    <div class="modal-tab">MOST RECENT</div>
                    <div class="modal-tab active" style="color:#0f172a; border-bottom-color:#f97316;">BROWSE ALL</div>
                </div>
                <button class="add-custom-btn"><i class="fas fa-plus-circle"></i> ADD CUSTOM EXERCISE</button>
            </div>

            <div class="modal-body">
                <div class="exercise-grid">
                    <div class="exercise-card" onclick="selectExercise('Cardio', 300)">
                        <i class="fas fa-biking"></i>
                        <div class="exercise-card-title">Cardio</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Gym', 400)">
                        <i class="fas fa-dumbbell"></i>
                        <div class="exercise-card-title">Gym</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Household Activity', 150)">
                        <i class="fas fa-home"></i>
                        <div class="exercise-card-title">Household<br>Activity</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Individual Sport', 450)">
                        <i class="fas fa-running"></i>
                        <div class="exercise-card-title">Individual Sport</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Occupational Activity', 200)">
                        <i class="fas fa-boxes"></i>
                        <div class="exercise-card-title">Occupational<br>Activity</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Outdoor Activity', 350)">
                        <i class="fas fa-hiking"></i>
                        <div class="exercise-card-title">Outdoor Activity</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Strength And Mobility', 250)">
                        <i class="fas fa-child"></i>
                        <div class="exercise-card-title">Strength And<br>Mobility</div>
                    </div>
                    <div class="exercise-card" onclick="selectExercise('Team Sport', 500)">
                        <i class="fas fa-futbol"></i>
                        <div class="exercise-card-title">Team Sport</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" id="workoutModalFooter">
                <div class="selected-food-info">
                    <div class="selected-name" id="selectedWorkoutName">Select an exercise...</div>
                </div>
                <form class="add-food-form" method="POST" action="{{ route('workout.add') }}">
                    @csrf
                    <input type="hidden" name="custom_exercise_name" id="formWorkoutName">
                    
                    <input type="number" name="duration_minutes" id="formWorkoutDuration" class="meal-select" placeholder="Mins" style="width: 80px;" required>
                    <input type="number" name="calories_burned" id="formWorkoutCals" class="meal-select" placeholder="KCAL" style="width: 100px;" required>

                    <button type="button" class="submit-food-btn" style="background:none; color:#10b981; border:none; padding:0; margin-right:1rem;" onclick="closeWorkoutModal()">CANCEL</button>
                    <button type="submit" class="submit-food-btn" style="background:#bae6fd; color:#0f172a;">ADD TO DIARY</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Premium Upgrade Modal Overlay -->
    <div class="modal-overlay" id="premiumModalOverlay">
        <div class="food-modal" style="max-width: 450px; text-align: center; padding: 2rem;">
            <div style="font-size: 3.5rem; color: #f59e0b; margin-bottom: 1rem;">
                <i class="fas fa-crown"></i>
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; text-transform: uppercase;">Unlock Premium Features</h2>
            <p style="color: #64748b; font-size: 1.05rem; line-height: 1.6; margin-bottom: 2rem;">
                Purchase our Premium Package to gain exclusive access to advanced biometric charts, personalized nutrient insights, and in-depth health reports. Elevate your fitness journey today!
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-direction: column;">
                <button class="submit-food-btn" style="background: #f59e0b; color: #fff; border: none; font-weight: 800; width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);" onclick="alert('Redirecting to secure payment gateway...'); closePremiumModal();">UPGRADE NOW</button>
                <button onclick="closePremiumModal()" style="background: none; border: none; color: #94a3b8; font-weight: 600; cursor: pointer; text-decoration: underline;">Maybe Later</button>
            </div>
        </div>
    </div>

    <!-- Leave a Review Modal -->
    <div class="modal-overlay" id="reviewModalOverlay">
        <div class="food-modal">
            <div class="modal-header">
                <h3 style="margin: 0;">Leave a Review</h3>
                <button class="close-btn" onclick="closeReviewModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <p style="color: #64748b; margin-bottom: 1.5rem;">Share your success story and inspire others! Your review may be featured on our homepage.</p>
                <form action="{{ route('review.add') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #0f172a;">Rating (1-5)</label>
                        <select name="rating" class="meal-select" style="width: 100%; border: 1px solid #e2e8f0;" required>
                            <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                            <option value="3">⭐⭐⭐ (3 Stars)</option>
                            <option value="2">⭐⭐ (2 Stars)</option>
                            <option value="1">⭐ (1 Star)</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #0f172a;">Your Review</label>
                        <textarea name="review_text" rows="4" style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.95rem;" placeholder="Write your success story here..." required></textarea>
                    </div>
                    <button type="submit" class="submit-food-btn" style="width: 100%;">SUBMIT REVIEW</button>
                </form>
            </div>
        </div>
    </div>

    </div> <!-- End Main Content -->
    </div> <!-- End App Layout -->

    <script>
        // View Switching Logic
        function switchView(view) {
            document.getElementById('diaryView').style.display = view === 'diary' ? 'block' : 'none';
            document.getElementById('trendsView').style.display = view === 'trends' ? 'block' : 'none';
            
            const menuDiary = document.getElementById('menuDiary');
            const menuTrends = document.getElementById('menuTrends');
            
            if(view === 'diary') {
                menuDiary.classList.add('active');
                menuTrends.classList.remove('active');
                
            } else if(view === 'trends') {
                menuTrends.classList.add('active');
                menuDiary.classList.remove('active');
                
                document.getElementById('trendsSubmenu').classList.add('active');
                document.getElementById('trendsChevron').classList.replace('fa-chevron-down', 'fa-chevron-up');
                
                // Initialize chart if not created yet
                if(!window.energyChartInstance) {
                    initChart();
                }
            }
        }

        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('active');
            let chevronId = id === 'trendsSubmenu' ? 'trendsChevron' : 'aboutChevron';
            const chevron = document.getElementById(chevronId);
            if(submenu.classList.contains('active')) {
                chevron.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                chevron.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        }

        function initChart() {
            const ctx = document.getElementById('energyChart').getContext('2d');
            
            const protein = {{ $protein_g }};
            const carbs = {{ $carbs_g }};
            const fat = {{ $fat_g }};

            window.energyChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Today'],
                    datasets: [
                        {
                            label: 'Protein',
                            data: [protein],
                            backgroundColor: '#4ade80', // Green
                            barPercentage: 0.4,
                            categoryPercentage: 0.8
                        },
                        {
                            label: 'Carbs',
                            data: [carbs],
                            backgroundColor: '#06b6d4', // Cyan
                            barPercentage: 0.4,
                            categoryPercentage: 0.8
                        },
                        {
                            label: 'Fat',
                            data: [fat],
                            backgroundColor: '#f97316', // Orange
                            barPercentage: 0.4,
                            categoryPercentage: 0.8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { family: 'Outfit', size: 12 } }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            max: Math.max(150, (protein + carbs + fat) * 1.2),
                            grid: { color: '#f1f5f9', borderDash: [5, 5] },
                            ticks: { color: '#94a3b8', font: { family: 'Outfit', size: 12 } },
                            border: { display: false }
                        }
                    }
                }
            });
        }

        // Modal Logic
        const overlay = document.getElementById('foodModalOverlay');
        const footer = document.getElementById('modalFooter');
        let selectedRow = null;

        function openFoodModal() {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            document.getElementById('foodSearchInput').focus();
        }

        function closeFoodModal() {
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close on clicking outside modal
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) closeFoodModal();
        });
        
        // Review Modal Logic
        const reviewOverlay = document.getElementById('reviewModalOverlay');
        function openReviewModal() {
            reviewOverlay.classList.add('active');
        }
        function closeReviewModal() {
            reviewOverlay.classList.remove('active');
        }

        // Search Food
        function filterFoods() {
            let filter = document.getElementById('foodSearchInput').value.toLowerCase();
            let rows = document.getElementById('foodTableBody').getElementsByClassName('food-row');
            for (let i = 0; i < rows.length; i++) {
                let txtValue = rows[i].textContent || rows[i].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function switchFoodTab(element, tab) {
            let tabs = document.getElementById('foodTabsContainer').getElementsByClassName('modal-tab');
            for(let i=0; i<tabs.length; i++) {
                tabs[i].classList.remove('active');
                tabs[i].style.color = '';
                tabs[i].style.borderBottomColor = '';
            }
            element.classList.add('active');
            element.style.color = '#0f172a';
            element.style.borderBottomColor = '#10b981';

            let rows = document.getElementById('foodTableBody').getElementsByClassName('food-row');
            let hasVisible = false;
            
            for (let i = 0; i < rows.length; i++) {
                if (tab === 'all' || tab === 'common') {
                    rows[i].style.display = "";
                    hasVisible = true;
                } else {
                    rows[i].style.display = "none";
                }
            }

            let emptyMsg = document.getElementById('emptyFoodMsg');
            if(!emptyMsg) {
                emptyMsg = document.createElement('tr');
                emptyMsg.id = 'emptyFoodMsg';
                emptyMsg.innerHTML = '<td colspan="2" style="text-align:center; padding: 3rem 1rem; color: #94a3b8; font-style: italic;">No items found in this category yet.</td>';
                document.getElementById('foodTableBody').appendChild(emptyMsg);
            }
            
            if(hasVisible) {
                emptyMsg.style.display = 'none';
            } else {
                emptyMsg.style.display = '';
            }
        }

        const userWeightGoal = '{{ Auth::user()->weight_goal }}';
        let selectedSuitability = 'universal';

        function selectFood(row) {
            if (selectedRow) selectedRow.classList.remove('selected');
            row.classList.add('selected');
            selectedRow = row;
            footer.classList.add('active');
            document.getElementById('selectedFoodName').innerText = row.getAttribute('data-name');
            document.getElementById('selectedFoodCals').innerText = row.getAttribute('data-cals') + " KCAL";
            document.getElementById('formFoodId').value = row.getAttribute('data-id');
            document.getElementById('formFoodName').value = row.getAttribute('data-name');
            document.getElementById('formFoodCals').value = row.getAttribute('data-cals');
            selectedSuitability = row.getAttribute('data-suitability');
        }

        document.getElementById('addFoodFormMain').addEventListener('submit', function(e) {
            if (userWeightGoal === 'lose' && selectedSuitability === 'gain') {
                if (!confirm("⚠️ SMART WARNING:\n\nThis item is highly caloric and better suited for weight gain. Adding it might exceed your daily deficit goal.\n\nDo you still want to add it?")) {
                    e.preventDefault();
                    return false;
                }
            }
        });

        // Workout Modal Logic
        const workoutOverlay = document.getElementById('workoutModalOverlay');
        const workoutFooter = document.getElementById('workoutModalFooter');

        function openWorkoutModal() {
            workoutOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeWorkoutModal() {
            workoutOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            workoutFooter.classList.remove('active');
        }

        workoutOverlay.addEventListener('click', function(e) {
            if (e.target === workoutOverlay) closeWorkoutModal();
        });

        let currentExerciseBurnRate = 0;

        function selectExercise(name, defaultCalsPerHour) {
            workoutFooter.classList.add('active');
            document.getElementById('selectedWorkoutName').innerText = name;
            document.getElementById('formWorkoutName').value = name;
            currentExerciseBurnRate = defaultCalsPerHour;
            
            // Reset inputs
            document.getElementById('formWorkoutDuration').value = '';
            document.getElementById('formWorkoutCals').value = '';
        }

        document.getElementById('formWorkoutDuration').addEventListener('input', function() {
            let mins = parseFloat(this.value);
            if (!isNaN(mins) && mins > 0) {
                let calories = Math.round((currentExerciseBurnRate / 60) * mins);
                document.getElementById('formWorkoutCals').value = calories;
            } else {
                document.getElementById('formWorkoutCals').value = '';
            }
        });

        function openPremiumModal() {
            document.getElementById('premiumModalOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePremiumModal() {
            document.getElementById('premiumModalOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('premiumModalOverlay').addEventListener('click', function(e) {
            if (e.target === this) closePremiumModal();
        });

        function addQuickWater() {
            let btn = document.getElementById('quickWaterBtn');
            let originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check" style="color:#10b981; font-size: 1.2rem;"></i> ADDED!';
            btn.style.pointerEvents = 'none';

            fetch('{{ route('dashboard.water') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({action: 'add_water'})
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 600);
            });
        }
    </script>
</body>
</html>
