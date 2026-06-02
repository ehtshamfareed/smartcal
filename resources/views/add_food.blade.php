<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=3" type="image/png">
    <title>Add Fuel - SmartCal</title>
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
        <div class="tool-header">
            <h1>Database Query</h1>
            <p>Access our macronutrient database or input custom entries for precise tracking.</p>
        </div>
        <div class="dashboard-grid"> 
            <div class="sidebar">
                <div class="card" style="margin-bottom: 2rem;">
                    @php
                        $user_goal = auth()->user()->weight_goal;
                        $tips_title = "";
                        $tips_desc = "";
                        $quick_adds = [];
                        if($user_goal == 'lose') {
                            $tips_title = "Fat Loss Protocols";
                            $tips_desc = "Optimize for high protein and high volume/fiber to maintain satiety in a caloric deficit.";
                            $quick_adds = [
                                ['name' => 'Boiled Egg (High Protein)', 'cals' => 78],
                                ['name' => 'Apple (High Fiber)', 'cals' => 95],
                                ['name' => 'Mixed Salad', 'cals' => 45]
                            ];
                        } elseif($user_goal == 'gain') {
                            $tips_title = "Mass Gain Protocols";
                            $tips_desc = "Prioritize calorie-dense, macro-rich foods to consistently hit your daily surplus targets.";
                            $quick_adds = [
                                ['name' => 'Banana (Quick Carbs)', 'cals' => 105],
                                ['name' => 'Whole Milk (1 Glass)', 'cals' => 150],
                                ['name' => 'Peanut Butter (1 tbsp)', 'cals' => 95]
                            ];
                        } else {
                            $tips_title = "Maintenance Protocols";
                            $tips_desc = "Balance your macronutrients and maintain a consistent caloric intake to hold your current mass.";
                            $quick_adds = [
                                ['name' => 'Handful of Almonds', 'cals' => 160],
                                ['name' => 'Yogurt', 'cals' => 100],
                                ['name' => 'Green Tea', 'cals' => 0]
                            ];
                        }
                    @endphp
                    <h2 style="font-size: 1.25rem;">Algorithmic Suggestions</h2>
                    <p style="color: var(--primary); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; margin-bottom: 0.5rem;">{{ $tips_title }}</p>
                    <p class="text-sm text-muted" style="margin-bottom: 1.5rem;">{{ $tips_desc }}</p>
                    <h3 style="font-size: 1rem; color: var(--gray-light); margin-bottom: 1rem; border-bottom: 1px solid var(--gray-dark); padding-bottom: 0.5rem;">Quick-Add Fuel</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($quick_adds as $qa)
                        <form method="POST" action="{{ route('food.add') }}">
                            @csrf
                            <input type="hidden" name="meal_type" value="snacks">
                            <input type="hidden" name="custom_food_name" value="{{ $qa['name'] }}">
                            <input type="hidden" name="calories" value="{{ $qa['cals'] }}">
                            <button type="submit" class="btn btn-outline" style="text-align: left; padding: 0.8rem 1rem; font-size: 0.85rem; width: 100%; border-color: var(--gray); color: var(--gray-light);">
                                + {{ $qa['name'] }} <span style="float: right; color: var(--primary); font-weight: 800;">{{ $qa['cals'] }} KCAL</span>
                            </button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="card">
                    <div style="margin-bottom: 2rem;">
                        <h2>Quick Database Select</h2>
                        <div class="category-tabs">
                            <a href="{{ route('food.add') }}" class="cat-tab {{ !request('cat') ? 'active' : '' }}">All Data</a>
                            @foreach($foods->pluck('category')->unique() as $cat)
                                <a href="{{ route('food.add', ['cat' => $cat]) }}" class="cat-tab {{ request('cat') == $cat ? 'active' : '' }}">{{ $cat }}</a>
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('food.add') }}" class="mt-1">
                            @csrf
                            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;">
                                <div class="form-group">
                                    <label>Target Meal Time</label>
                                    <select name="meal_type" class="form-control" required style="cursor: pointer;">
                                        <option value="breakfast">Breakfast</option>
                                        <option value="lunch">Lunch</option>
                                        <option value="dinner">Dinner</option>
                                        <option value="snacks" selected>Post/Pre-Workout & Snacks</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Fuel Source</label>
                                    <select name="food_id" class="form-control" style="cursor: pointer;">
                                        <option value="">Select an item from the database...</option>
                                        @foreach($foods as $f)
                                            <option value="{{ $f->id }}" data-calories="{{ $f->calories }}">
                                                {{ $f->name }} ({{ $f->calories }} KCAL)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="calories" id="selected_calories" value="0">
                            <script>
                                document.querySelector('select[name="food_id"]').addEventListener('change', function() {
                                    var opt = this.options[this.selectedIndex];
                                    document.getElementById('selected_calories').value = opt.getAttribute('data-calories') || 0;
                                });
                            </script>
                            <button type="submit" class="btn mt-1" style="width: auto; padding-left: 3rem; padding-right: 3rem;">COMMIT TO LOG</button>
                        </form>
                    </div> 
                    <div style="margin-top: 3rem; border-top: 2px solid var(--gray); padding-top: 2rem;">
                        <h2>Manual Entry</h2>
                        <p class="text-muted" style="margin-bottom: 1.5rem;">For unlisted supplements or complex custom macros.</p>
                        <form method="POST" action="{{ route('food.add') }}">
                            @csrf
                            <div style="display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 1.5rem;">
                                <div class="form-group">
                                    <label>Meal Time</label>
                                    <select name="meal_type" class="form-control" required style="cursor: pointer;">
                                        <option value="breakfast">Breakfast</option>
                                        <option value="lunch">Lunch</option>
                                        <option value="dinner">Dinner</option>
                                        <option value="snacks" selected>Post/Pre-Workout & Snacks</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="custom_food_name" class="form-control" placeholder="e.g. Custom Whey Shake" required>
                                </div>
                                <div class="form-group">
                                    <label>Total Calories</label>
                                    <input type="number" step="0.1" name="calories" class="form-control" placeholder="e.g. 350" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline mt-1" style="width: auto;">+ INSERT RECORD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
