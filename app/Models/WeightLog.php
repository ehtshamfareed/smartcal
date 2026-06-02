<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    protected $fillable = ['user_id', 'date', 'weight_kg', 'is_deleted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
