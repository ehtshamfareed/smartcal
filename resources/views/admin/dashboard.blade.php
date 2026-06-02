@extends('layouts.admin')
@section('title', 'Command Center - SmartCal Admin')
@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Admin Control Center</h1>
        <p>Platform Metrics and Datasets Overview.</p>
    </div>
</div>
<div class="masonry-grid">
    <div class="stat-box">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-content">
            <p class="stat-label">Registered Members</p>
            <div class="stat-value">{{ $total_users }}</div>
        </div>
    </div>
    <div class="stat-box green">
        <div class="stat-icon"><i class="fas fa-apple-alt"></i></div>
        <div class="stat-content">
            <p class="stat-label">Global Food Database</p>
            <div class="stat-value">{{ $total_foods }} <span>Items</span></div>
        </div>
    </div>
    <div class="stat-box blue">
        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
        <div class="stat-content">
            <p class="stat-label">Daily Logs Recorded</p>
            <div class="stat-value">{{ $total_logs }} <span>Logs</span></div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
        <h3>Recent Members</h3>
    </div>
    @if($recent_users->isEmpty())
        <p style="padding: 3rem; background: #f8fafc; text-align: center; color: #64748b;">No active users found in the system registry.</p>
    @else
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member Name</th>
                        <th>Email Contact</th>
                        <th>Age</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_users as $ru)
                    <tr>
                        <td style="color: var(--primary); font-weight: 700; font-family: 'Outfit';">#{{ sprintf("%03d", $ru->id) }}</td>
                        <td style="color: #0f172a; font-weight: 700; font-family: 'Outfit';">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; justify-content: center; align-items: center; font-weight: 800; font-size: 1rem; border: 2px solid rgba(16, 185, 129, 0.2);">
                                    {{ strtoupper(substr($ru->name, 0, 1)) }}
                                </div>
                                <span>{{ $ru->name }}</span>
                            </div>
                        </td>
                        <td style="color: var(--gray); font-family: 'Outfit';">{{ $ru->email }}</td>
                        <td style="color: #0f172a; font-weight: 600; font-family: 'Outfit';">{{ $ru->age }} YRS</td>
                        <td>
                            <span style="background: #f1f5f9; color: var(--gray); border: 1px solid #e2e8f0; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                                {{ ucfirst($ru->gender) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 1.5rem; text-align: right;">
            <a href="{{ route('admin.users') }}" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.6rem 1.5rem;">VIEW FULL DIRECTORY →</a>
        </div>
    @endif
</div>
@endsection
