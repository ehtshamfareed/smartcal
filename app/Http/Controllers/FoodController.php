<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FoodItem;
use App\Models\DailyLog;
use Illuminate\Support\Facades\Auth;
class FoodController extends Controller
{
    public function showAddFood()
    {
        $foods = FoodItem::where('is_deleted', 0)->get();
        return view('add_food', compact('foods'));
    }
    public function storeLog(Request $request)
    {
        $request->validate([
            'meal_type' => 'required',
        ]);
        $food_name = $request->custom_food_name;
        $calories = $request->calories;
        if ($request->food_id) {
            $food = FoodItem::find($request->food_id);
            if ($food) {
                $food_name = $food->name;
                $calories = $food->calories;
            }
        }
        DailyLog::create([
            'user_id' => Auth::id(),
            'date' => date('Y-m-d'),
            'food_item_id' => $request->food_id,
            'custom_food_name' => $food_name,
            'meal_type' => $request->meal_type,
            'calories' => $calories,
        ]);
        return redirect()->route('dashboard');
    }
    public function deleteLog($id)
    {
        $log = DailyLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->update(['is_deleted' => 1]);
        return redirect()->route('dashboard');
    }
}
