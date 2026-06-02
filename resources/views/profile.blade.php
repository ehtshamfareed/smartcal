<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=3" type="image/png">
    <title>Bio-Metrics - SmartCal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <i class="fas fa-leaf" style="color:var(--primary); font-size:1.5rem; margin-right:5px;"></i><span>Smart</span>Cal
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('profile') }}" style="color:var(--primary);">My Profile</a>
                <a href="{{ route('logout') }}">Sign Out</a>
            </div>
        </nav>
        <div class="tool-header">
            <h1>Bio-Metric Profile</h1>
            <p>Precise data yields optimal results. Update your metrics to recalculate your caloric requirements.</p>
        </div>
        @php
            $height_m = $user->height_cm / 100;
            $bmi = 0;
            if($height_m > 0) {
                $bmi = round($user->weight_kg / ($height_m * $height_m), 1);
            }
            $bmi_status = "";
            $bmi_color = "";
            if($bmi < 18.5) { $bmi_status = "Underweight"; $bmi_color = "#FFB300"; }
            elseif($bmi < 25) { $bmi_status = "Normal"; $bmi_color = "#4CAF50"; }
            elseif($bmi < 30) { $bmi_status = "Overweight"; $bmi_color = "#FF9800"; }
            else { $bmi_status = "Obese"; $bmi_color = "#F44336"; }
        @endphp
        <div class="card" style="max-width: 800px; margin: 0 auto; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--gray); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h2 style="margin: 0; border: none; padding: 0;">Update Bio-Metrics</h2>
                <div style="text-align: right;">
                    <div style="font-size: 0.8rem; color: var(--gray-light); text-transform: uppercase;">Current BMI</div>
                    <div style="font-size: 2rem; font-weight: 800; font-family: 'Montserrat'; color: {{ $bmi_color }}; line-height: 1;">{{ $bmi }}</div>
                    <div style="font-size: 0.8rem; font-weight: 600; color: {{ $bmi_color }}; text-transform: uppercase;">{{ $bmi_status }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('profile') }}">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Age (years)</label>
                        <input type="number" name="age" value="{{ $user->age }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Biological Gender</label>
                        <select name="gender" class="form-control" style="cursor: pointer;">
                            <option value="male" {{ $user->gender=='male'?'selected':'' }}>Male</option>
                            <option value="female" {{ $user->gender=='female'?'selected':'' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Height (cm)</label>
                        <input type="number" name="height_cm" value="{{ $user->height_cm }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" step="0.1" name="weight_kg" value="{{ $user->weight_kg }}" class="form-control" required>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1.5rem;">
                    <div class="form-group">
                        <label>Activity Modifier</label>
                        <select name="activity_level" class="form-control" style="cursor: pointer;">
                            <option value="sedentary" {{ $user->activity_level=='sedentary'?'selected':'' }}>Sedentary (Little to no exercise)</option>
                            <option value="light" {{ $user->activity_level=='light'?'selected':'' }}>Light (Training 1-3 days/week)</option>
                            <option value="moderate" {{ $user->activity_level=='moderate'?'selected':'' }}>Moderate (Training 3-5 days/week)</option>
                            <option value="active" {{ $user->activity_level=='active'?'selected':'' }}>Active (Training 6-7 days/week)</option>
                            <option value="very_active" {{ $user->activity_level=='very_active'?'selected':'' }}>Very Active (Intense training/Physical job)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Primary Protocol (Weight Goal)</label>
                        <select name="weight_goal" class="form-control" style="cursor: pointer;">
                            <option value="lose" {{ $user->weight_goal=='lose'?'selected':'' }}>Fat Loss (Deficit phase)</option>
                            <option value="maintain" {{ $user->weight_goal=='maintain'?'selected':'' }}>Maintenance (Steady state)</option>
                            <option value="gain" {{ $user->weight_goal=='gain'?'selected':'' }}>Mass Gain (Surplus phase)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn mt-2" style="width: auto; padding-left: 3rem; padding-right: 3rem;">UPDATE METRICS & LOG WEIGHT</button>
            </form>
        </div>
        @php
            $weight_history = \App\Models\WeightLog::where('user_id', $user->id)
                ->where('is_deleted', 0)
                ->orderBy('date', 'asc')
                ->take(30)
                ->get();
            $chart_dates = $weight_history->pluck('date')->toArray();
            $chart_weights = $weight_history->pluck('weight_kg')->toArray();
        @endphp
        @if(count($weight_history) > 1)
        <div class="card" style="max-width: 800px; margin: 0 auto; margin-bottom: 3rem;">
            <h2 style="margin-bottom: 1.5rem;">Weight Trajectory (30-Day Limit)</h2>
            <div style="height: 300px; width: 100%;">
                <canvas id="weightChart"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        const ctx = document.getElementById('weightChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_dates) !!},
                datasets: [{
                    label: 'Weight (kg)',
                    data: {!! json_encode($chart_weights) !!},
                    borderColor: '#FF3B00',
                    backgroundColor: 'rgba(255, 59, 0, 0.1)',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#FF3B00',
                    pointBorderColor: '#1A1A1A',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#CCCCCC' }
                    },
                    x: {
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#CCCCCC' }
                    }
                }
            }
        });
        </script>
        @else
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <p class="text-sm text-muted">Weight trajectory chart will unlock after multiple logs are recorded.</p>
        </div>
        @endif
    </div>
</body>
</html>
