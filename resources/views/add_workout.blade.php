<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=3" type="image/png">
    <title>Log Workout - SmartCal</title>
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
                <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
            </div>
        </nav>
        <div class="tool-header" style="border-bottom-color: #4CAF50;">
            <h1 style="color: #4CAF50;">Log Physical Activity</h1>
            <p>Select from the MET database or provide custom metrics to track Calories OUT.</p>
        </div>
        <div class="card" style="margin-bottom: 2rem; border-top: 4px solid #4CAF50;">
            <h2>MET Database Query</h2>
            <p class="text-muted" style="margin-bottom: 1.5rem;">Select an exercise. The system will use your body weight (<strong style="color: var(--white);">{{ auth()->user()->weight_kg }} kg</strong>) and the Metabolic Equivalent formula to calculate total burn based on duration.</p>
            <div class="category-tabs">
                <a href="{{ route('workout.add') }}" class="cat-tab {{ !request('cat') ? 'active' : '' }}">All Activities</a>
                @foreach($exercises->pluck('category')->unique() as $cat)
                    <a href="{{ route('workout.add', ['cat' => $cat]) }}" class="cat-tab {{ request('cat') == $cat ? 'active' : '' }}">{{ $cat }}</a>
                @endforeach
            </div>
            <form method="POST" action="{{ route('workout.add') }}" class="mt-1">
                @csrf
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Exercise Type</label>
                        <select name="exercise_id" class="form-control" required style="cursor: pointer;">
                            <option value="">Select an activity...</option>
                            @foreach($exercises as $ex)
                                <option value="{{ $ex->id }}">
                                    {{ $ex->name }} (Intensity: {{ $ex->category }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Duration (Minutes)</label>
                        <input type="number" name="duration" class="form-control" placeholder="e.g. 45" required>
                    </div>
                </div>
                <button type="submit" class="btn mt-1" style="background: #4CAF50; width: auto; padding-left: 3rem; padding-right: 3rem;">PROCESS WORKOUT</button>
            </form>
        </div> 
        <div class="card" style="margin-bottom: 2rem;">
            <h2>Manual Data Override</h2>
            <p class="text-muted" style="margin-bottom: 1.5rem;">For unlisted sports or data pulled directly from your smartwatch/fitness tracker.</p>
            <form method="POST" action="{{ route('workout.add') }}">
                @csrf
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Activity Name</label>
                        <input type="text" name="custom_exercise_name" class="form-control" placeholder="e.g. Intense Squash Match" required>
                    </div>
                    <div class="form-group">
                        <label>Duration (Mins)</label>
                        <input type="number" name="duration" class="form-control" placeholder="e.g. 60" required>
                    </div>
                    <div class="form-group">
                        <label>Total Burn (KCAL)</label>
                        <input type="number" step="0.1" name="custom_calories" class="form-control" placeholder="e.g. 550" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline mt-1" style="border-color: #4CAF50; color: #4CAF50; width: auto;">+ INSERT RECORD</button>
            </form>
        </div>
    </div>
</body>
</html>
