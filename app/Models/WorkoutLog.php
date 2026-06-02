<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    protected $fillable = ['user_id', 'date', 'exercise_id', 'custom_exercise_name', 'duration_minutes', 'calories_burned', 'is_deleted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
