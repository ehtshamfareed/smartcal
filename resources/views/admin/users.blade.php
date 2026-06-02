@extends('layouts.admin')
@section('title', 'User Directory - SmartCal Admin')
@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Member Directory</h1>
        <p>Monitor, review, and manage active member accounts across the system.</p>
    </div>
</div>
<div class="card">
    <div class="table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Profile</th>
                    <th>Contact Email</th>
                    <th>Health Metrics</th>
                    <th>Activity Level</th>
                    <th style="text-align: center;">Total Logs</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td style="color: var(--primary); font-weight: 700; font-family: 'Outfit';">#{{ sprintf("%03d", $u->id) }}</td>
                    <td style="color: #0f172a; font-weight: 700; font-family: 'Outfit';">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; justify-content: center; align-items: center; font-weight: 800; font-size: 1.1rem; border: 2px solid rgba(16, 185, 129, 0.2);">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <span>{{ $u->name }}</span>
                        </div>
                    </td>
                    <td style="color: var(--gray-light); font-family: 'Outfit';">{{ $u->email }}</td>
                    <td style="font-size: 0.95rem; color: var(--gray-light); font-family: 'Outfit';">
                        {{ $u->age }} YRS • {{ strtoupper($u->gender) }}<br>
                        <span style="color: #0f172a; font-weight: 700;">{{ $u->height_cm }} CM</span> / <span style="color: var(--primary); font-weight: 700;">{{ $u->weight_kg }} KG</span>
                    </td>
                    <td>
                        <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase;">
                            {{ str_replace('_', ' ', strtoupper($u->activity_level)) }}
                        </span>
                    </td>
                    <td style="font-weight: 800; font-size: 1.1rem; color: #10b981; text-align: center;">
                        {{ $u->daily_logs_count }}
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 0.8rem; justify-content: flex-end;">
                            <a href="{{ route('admin.user.logs', $u->id) }}" style="width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; border-radius: 8px; border: 1px solid #bae6fd; background: rgba(56, 189, 248, 0.1); color: #0284c7; text-decoration: none; transition: 0.2s;" title="View Logs" onmouseover="this.style.background='#bae6fd'" onmouseout="this.style.background='rgba(56, 189, 248, 0.1)'">
                                <i class="fas fa-folder-open"></i>
                            </a>
                            <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" onsubmit="return confirm('Wipe all data for {{ $u->name }}?');" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; border-radius: 8px; border: 1px solid #fecaca; background: rgba(239, 68, 68, 0.1); color: #dc2626; cursor: pointer; transition: 0.2s;" title="Delete User" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="padding: 3rem; text-align: center; color: var(--gray-light);">No operational users detected.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
