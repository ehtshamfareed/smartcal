<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['name', 'category', 'suitability', 'serving_size', 'calories', 'is_deleted'];
}
