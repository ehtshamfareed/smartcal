<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\WorkoutLog;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function showAddWorkout()
    {
        $exercises = Exercise::where('is_deleted', 0)->get();
        return view('add_workout', compact('exercises'));
    }

    public function storeLog(Request $request)
    {
        $request->validate([
            'duration_minutes' => 'required|numeric',
        ]);

        $exercise_name = $request->custom_exercise_name;
        $calories_burned = $request->calories_burned ?? 0;
        $user = Auth::user();

        if ($request->exercise_id) {
            $ex = Exercise::find($request->exercise_id);
            if ($ex) {
                $exercise_name = $ex->name;
            }
        }

        WorkoutLog::create([
            'user_id' => $user->id,
            'date' => date('Y-m-d'),
            'exercise_id' => $request->exercise_id,
            'custom_exercise_name' => $exercise_name,
            'duration_minutes' => $request->duration_minutes,
            'calories_burned' => $calories_burned,
        ]);

        return redirect()->route('dashboard');
    }

    public function deleteLog($id)
    {
        $log = WorkoutLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->update(['is_deleted' => 1]);
        return redirect()->route('dashboard');
    }
}
