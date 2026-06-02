@extends('layouts.admin')

@section('title', 'Recruit File - SmartCal Admin')

@section('admin_content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.users') }}" style="color: var(--gray-light); text-decoration: none; font-weight: 600; font-size: 0.9rem; text-transform: uppercase;"><i class="fas fa-arrow-left"></i> Return to Directory</a>
</div>

<div class="page-header">
    <div class="page-title">
        <h1 style="display: flex; align-items: center; gap: 1rem;">
            <span>{{ $user->name }}</span>
            <span style="font-size: 0.9rem; padding: 0.3rem 0.8rem; background: #f1f5f9; border-radius: 50px; color: #64748b; font-weight: 700;">ID: #{{ sprintf("%03d", $user->id) }}</span>
        </h1>
        <p style="margin-top: 0.5rem;">Goal: <strong style="color: var(--primary);">{{ str_replace('_', ' ', strtoupper($user->weight_goal ?? 'MAINTAIN')) }}</strong></p>
    </div>
    <div style="text-align: right; color: #64748b; font-size: 0.95rem;">
        <strong>Age:</strong> {{ $user->age }} YRS &nbsp;|&nbsp; 
        <strong>Weight:</strong> {{ $user->weight_kg }} KG &nbsp;|&nbsp; 
        <strong>Height:</strong> {{ $user->height_cm }} CM<br>
        <strong>Activity Level:</strong> <span style="color: #0f172a; font-weight: 700;">{{ strtoupper($user->activity_level) }}</span>
    </div>
</div>

<div class="masonry-grid">
    <div class="stat-box">
        <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
        <div class="stat-content">
            <p class="stat-label">7-Day Rolling Average</p>
            <div class="stat-value">{{ $avg_7_days }} <span>KCAL/DAY</span></div>
        </div>
    </div>
    
    <div class="stat-box green">
        <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
        <div class="stat-content">
            <p class="stat-label">Data Logs Recorded</p>
            <div class="stat-value">{{ $user->daily_logs_count }} <span>LOGS</span></div>
        </div>
    </div>
    
    <div class="stat-box blue">
        <div class="stat-icon"><i class="fas fa-chart-area"></i></div>
        <div class="stat-content">
            <p class="stat-label">Total Monthly Record</p>
            <div class="stat-value">{{ number_format($month_total) }} <span>KCAL</span></div>
        </div>
    </div>
</div>

<h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; font-weight: 800; color: #0f172a;">Detailed Activity Log</h2>

@if(empty($grouped_logs))
    <div class="card" style="text-align: center; padding: 4rem;">
        <p style="color: #64748b; font-size: 1.5rem; font-weight: 800; text-transform: uppercase;"><i class="fas fa-search"></i> No Data Signals Detected</p>
        <p style="color: #94a3b8; margin: 0;">This member has not logged any dietary activities yet.</p>
    </div>
@else
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        @foreach($grouped_logs as $date => $logs)
        <div class="card" style="padding: 0; overflow: hidden; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
            <div class="card-header" style="background: #ffffff; padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; margin: 0; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="text-transform: uppercase; margin: 0; font-size: 1.1rem; color: #0f172a; font-weight: 800;">
                    <i class="fas fa-calendar-day" style="color: #38bdf8; margin-right: 0.5rem;"></i>
                    {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                </h3>
                <div style="font-size: 1.1rem; font-weight: 800; color: #10b981; display: flex; align-items: baseline; gap: 1rem;">
                    @if(isset($water_logs[$date]) && $water_logs[$date]->glasses > 0)
                        <span style="color: #38bdf8; font-size: 0.95rem;">
                            <i class="fas fa-tint"></i> {{ $water_logs[$date]->glasses }} Glasses
                        </span>
                    @endif
                    <span>{{ number_format($logs->sum('calories')) }} <span style="font-size: 0.75rem; color: #64748b; font-weight: 700;">KCAL TOTAL</span></span>
                </div>
            </div>
            <div style="padding: 0 2rem;">
                @if(isset($water_logs[$date]) && $water_logs[$date]->glasses > 0)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 0; background: #fff; border-bottom: 1px dashed #e2e8f0; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='#fff'">
                    <div style="display: flex; align-items: center; gap: 1rem; padding-left: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(56, 189, 248, 0.1); color: #38bdf8; display: flex; justify-content: center; align-items: center; font-size: 1.1rem;">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.05rem; color: #0f172a; font-weight: 800; font-family: 'Outfit';">
                                Water Hydration
                            </div>
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">
                                DAILY INTAKE
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 800; font-size: 1.2rem; color: #38bdf8; padding-right: 1rem;">
                        {{ $water_logs[$date]->glasses }} <span style="font-size: 0.7rem; color: #94a3b8;">GLASSES</span>
                    </div>
                </div>
                @endif
                
                @if(isset($weight_logs[$date]))
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 0; background: #fff; border-bottom: 1px dashed #e2e8f0; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='#fff'">
                    <div style="display: flex; align-items: center; gap: 1rem; padding-left: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; justify-content: center; align-items: center; font-size: 1.1rem;">
                            <i class="fas fa-weight"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.05rem; color: #0f172a; font-weight: 800; font-family: 'Outfit';">
                                Body Weight
                            </div>
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">
                                DAILY MEASUREMENT
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 800; font-size: 1.2rem; color: #f59e0b; padding-right: 1rem;">
                        {{ $weight_logs[$date]->weight_kg }} <span style="font-size: 0.7rem; color: #94a3b8;">KG</span>
                    </div>
                </div>
                @endif
                
                @if(isset($workout_logs[$date]))
                    @foreach($workout_logs[$date] as $workout)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 0; background: #fff; border-bottom: 1px dashed #e2e8f0; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='#fff'">
                        <div style="display: flex; align-items: center; gap: 1rem; padding-left: 1rem;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; justify-content: center; align-items: center; font-size: 1.1rem;">
                                <i class="fas fa-dumbbell"></i>
                            </div>
                            <div>
                                <div style="font-size: 1.05rem; color: #0f172a; font-weight: 800; font-family: 'Outfit';">
                                    {{ $workout->custom_exercise_name ?: 'Workout' }}
                                </div>
                                <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">
                                    {{ $workout->duration_minutes }} MINS WORKOUT
                                </div>
                            </div>
                        </div>
                        <div style="font-weight: 800; font-size: 1.2rem; color: #ef4444; padding-right: 1rem;">
                            {{ $workout->calories_burned }} <span style="font-size: 0.7rem; color: #94a3b8;">KCAL BURNED</span>
                        </div>
                    </div>
                    @endforeach
                @endif
                @foreach($logs as $log)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 0; background: #fff; border-bottom: 1px dashed #e2e8f0; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='#fff'">
                    <div style="display: flex; align-items: center; gap: 1rem; padding-left: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; justify-content: center; align-items: center; font-size: 1.1rem;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div>
                            <div style="font-size: 1.05rem; color: #0f172a; font-weight: 800; font-family: 'Outfit';">
                                {{ $log->custom_food_name }}
                            </div>
                            <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">
                                {{ $log->meal_type }}
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 800; font-size: 1.2rem; color: #10b981; padding-right: 1rem;">
                        {{ $log->calories }} <span style="font-size: 0.7rem; color: #94a3b8;">KCAL</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
