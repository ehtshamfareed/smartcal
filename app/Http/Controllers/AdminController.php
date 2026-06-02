<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FoodItem;
use App\Models\DailyLog;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function dashboard()
    {
        $total_users = User::where('role', 'user')->where('is_deleted', 0)->count();
        $total_foods = FoodItem::where('is_deleted', 0)->count();
        $total_logs = DailyLog::where('is_deleted', 0)->count();
        $recent_users = User::where('role', 'user')->where('is_deleted', 0)
                            ->orderBy('id', 'desc')->limit(5)->get();
        return view('admin.dashboard', compact('total_users', 'total_foods', 'total_logs', 'recent_users'));
    }
    public function users()
    {
        $users = User::where('role', 'user')->where('is_deleted', 0)
                     ->withCount(['dailyLogs' => function($query) {
                         $query->where('is_deleted', 0);
                     }])->orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }
    public function deleteUser($id)
    {
        User::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('admin.users');
    }
    public function foods()
    {
        $foods = FoodItem::where('is_deleted', 0)->get();
        return view('admin.foods', compact('foods'));
    }
    public function showAddFood()
    {
        return view('admin.food_add');
    }
    public function storeFood(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'suitability' => 'required|string|in:universal,loss,gain',
            'serving_size' => 'required|string|max:100',
            'calories' => 'required|numeric|min:0'
        ]);
        FoodItem::create($data);
        return redirect()->route('admin.foods');
    }
    public function deleteFood($id)
    {
        $food = FoodItem::findOrFail($id);
        $food->is_deleted = 1;
        $food->save();
        return redirect()->route('admin.foods');
    }
    public function exercises()
    {
        $exercises = \App\Models\Exercise::where('is_deleted', 0)->get();
        return view('admin.exercises', compact('exercises'));
    }
    public function showAddExercise()
    {
        return view('admin.exercise_add');
    }
    public function storeExercise(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Cardio,Strength,Flexibility,Sports',
            'met_value' => 'required|numeric|min:0'
        ]);
        \App\Models\Exercise::create($data);
        return redirect()->route('admin.exercises');
    }
    public function deleteExercise($id)
    {
        $exercise = \App\Models\Exercise::findOrFail($id);
        $exercise->is_deleted = 1;
        $exercise->save();
        return redirect()->route('admin.exercises');
    }
    public function userLogs($id)
    {
        $user = User::where('id', $id)->where('role', 'user')->withCount(['dailyLogs' => function($query) {
            $query->where('is_deleted', 0);
        }])->firstOrFail();
        $date = date('Y-m-d');
        $avg_7_days = DailyLog::where('user_id', $id)
            ->where('date', '>=', now()->subDays(7))
            ->where('is_deleted', 0)
            ->selectRaw('SUM(calories) as daily_sum, date')
            ->groupBy('date')
            ->get()
            ->avg('daily_sum') ?? 0;
        $avg_7_days = round($avg_7_days);
        $month_total = DailyLog::where('user_id', $id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('is_deleted', 0)
            ->sum('calories') ?: 0;
        $daily_logs = DailyLog::where('user_id', $id)
            ->where('is_deleted', 0)
            ->orderBy('meal_type', 'asc')
            ->get();
        $water_logs_query = \App\Models\WaterLog::where('user_id', $id)->get();
        $workout_logs_query = \App\Models\WorkoutLog::where('user_id', $id)->where('is_deleted', 0)->get();
        $weight_logs_query = \App\Models\WeightLog::where('user_id', $id)->where('is_deleted', 0)->get();
        $all_dates = $daily_logs->pluck('date')
            ->merge($water_logs_query->pluck('date'))
            ->merge($workout_logs_query->pluck('date'))
            ->merge($weight_logs_query->pluck('date'))
            ->unique()->sortDesc();
        $grouped_logs = [];
        foreach ($all_dates as $date) {
            $grouped_logs[$date] = $daily_logs->where('date', $date);
        }
        $water_logs = $water_logs_query->keyBy('date');
        $workout_logs = $workout_logs_query->groupBy('date');
        $weight_logs = $weight_logs_query->keyBy('date');
        return view('admin.user_logs', compact('user', 'avg_7_days', 'month_total', 'grouped_logs', 'water_logs', 'workout_logs', 'weight_logs'));
    }
    public function reviews()
    {
        $reviews = \App\Models\Review::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews', compact('reviews'));
    }
    public function approveReview($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->is_approved = 1;
        $review->save();
        return redirect()->route('admin.reviews');
    }
    public function deleteReview($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews');
    }
}
