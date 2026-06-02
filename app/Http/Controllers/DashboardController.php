<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyLog;
use App\Models\WorkoutLog;
use App\Models\WaterLog;
use App\Models\User;
use App\Models\FoodItem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $date = date('Y-m-d');

        // BMR Calculation
        if ($user->gender == 'male') {
            $bmr = (10 * $user->weight_kg) + (6.25 * $user->height_cm) - (5 * $user->age) + 5;
        } else {
            $bmr = (10 * $user->weight_kg) + (6.25 * $user->height_cm) - (5 * $user->age) - 161;
        }

        $multipliers = [
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9,
        ];
        
        $tdee = round($bmr * ($multipliers[$user->activity_level] ?? 1.2));
        $recommended_calories = $tdee;
        $goal_text = "Maintenance Phase";

        if ($user->weight_goal == 'lose') {
            $recommended_calories = $tdee - 500;
            $goal_text = "Deficit Phase (Fat Loss)";
        } elseif ($user->weight_goal == 'gain') {
            $recommended_calories = $tdee + 500;
            $goal_text = "Surplus Phase (Mass Gain)";
        }

        $consumed_calories = DailyLog::where('user_id', $user->id)
            ->where('date', $date)
            ->where('is_deleted', 0)
            ->sum('calories');

        $burned_calories = WorkoutLog::where('user_id', $user->id)
            ->where('date', $date)
            ->where('is_deleted', 0)
            ->sum('calories_burned');

        $net_calories = max(0, $consumed_calories - $burned_calories);
        $remaining = $recommended_calories - $net_calories;

        $logs = DailyLog::where('user_id', $user->id)
            ->where('date', $date)
            ->where('is_deleted', 0)
            ->orderBy('meal_type')
            ->get();

        $workouts = WorkoutLog::where('user_id', $user->id)
            ->where('date', $date)
            ->where('is_deleted', 0)
            ->get();

        $water_log = WaterLog::where('user_id', $user->id)
            ->where('date', $date)
            ->first();
        $water_glasses = $water_log ? $water_log->glasses : 0;

        // 7-day average (approximate logic based on current PHP)
        $avg_7_days = DailyLog::where('user_id', $user->id)
            ->where('date', '>=', now()->subDays(7))
            ->where('is_deleted', 0)
            ->groupBy('date')
            ->selectRaw('SUM(calories) as daily_total')
            ->get()
            ->avg('daily_total') ?? 0;
        
        // Subtract burned calories from average too
        $avg_burn_7 = WorkoutLog::where('user_id', $user->id)
            ->where('date', '>=', now()->subDays(7))
            ->where('is_deleted', 0)
            ->groupBy('date')
            ->selectRaw('SUM(calories_burned) as daily_burn')
            ->get()
            ->avg('daily_burn') ?? 0;
        
        $avg_7_days = round($avg_7_days - $avg_burn_7);

        $month_total_burn = WorkoutLog::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('is_deleted', 0)
            ->sum('calories_burned');

        $foods = FoodItem::where('is_deleted', 0)->get();

        // Calculate Real-Time Macros based on consumed calories
        $carbs_cals = $consumed_calories * 0.50;
        $protein_cals = $consumed_calories * 0.25;
        $fat_cals = $consumed_calories * 0.25;

        $carbs_g = round($carbs_cals / 4, 1);
        $protein_g = round($protein_cals / 4, 1);
        $fat_g = round($fat_cals / 9, 1);

        // Calculate a few micros for the report (simulated based on caloric intake for demonstration)
        $micros = [
            'calcium' => round($consumed_calories * 0.4, 1), // mg
            'iron' => round($consumed_calories * 0.005, 1), // mg
            'vit_c' => round($consumed_calories * 0.03, 1), // mg
            'potassium' => round($consumed_calories * 1.5, 1), // mg
            'fiber' => round($consumed_calories * 0.015, 1), // g
            'water' => round($consumed_calories * 0.02, 1), // g
            'vit_a' => round($consumed_calories * 0.3, 1), // mcg
            'vit_b12' => round($consumed_calories * 0.001, 2), // mcg
        ];

        return view('dashboard', compact(
            'user', 'recommended_calories', 'goal_text', 'consumed_calories', 
            'burned_calories', 'net_calories', 'remaining', 'logs', 
            'workouts', 'water_glasses', 'avg_7_days', 'month_total_burn', 'foods',
            'carbs_g', 'protein_g', 'fat_g', 'micros'
        ));
    }

    public function logWater(Request $request)
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        $log = WaterLog::firstOrNew(['user_id' => $user->id, 'date' => $date]);
        $log->glasses = $request->glasses;
        $log->save();

        return response()->json(['success' => true]);
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
        ]);

        \App\Models\Review::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'is_approved' => 0
        ]);

        return redirect()->route('dashboard')->with('success', 'Your review has been submitted and is pending approval.');
    }

    public function updateWater(Request $request)
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        $action = $request->input('action');

        $water_log = WaterLog::firstOrCreate(
            ['user_id' => $user->id, 'date' => $date],
            ['glasses' => 0, 'daily_goal' => 8]
        );

        if ($action == 'add_water') {
            if ($water_log->glasses < 20) {
                $water_log->increment('glasses');
            }
        } elseif ($action == 'remove_water') {
            if ($water_log->glasses > 0) {
                $water_log->decrement('glasses');
            }
        }

        return redirect()->route('dashboard');
    }
}
