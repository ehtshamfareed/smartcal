<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        \App\Models\User::create([
            'name' => 'System Admin',
            'email' => 'admin@smartcal.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Regular User
        \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'user',
            'age' => 28,
            'gender' => 'male',
            'height_cm' => 175,
            'weight_kg' => 75,
            'activity_level' => 'moderate',
            'weight_goal' => 'maintain',
        ]);

        // Exercises
        $exercises = [
            ['name' => 'Walking (Brisk)', 'category' => 'Cardio', 'met_value' => 4.3],
            ['name' => 'Running (Jogging)', 'category' => 'Cardio', 'met_value' => 7.0],
            ['name' => 'Running (Fast)', 'category' => 'Cardio', 'met_value' => 11.5],
            ['name' => 'Cycling (Moderate)', 'category' => 'Cardio', 'met_value' => 8.0],
            ['name' => 'Weight Lifting (General)', 'category' => 'Strength', 'met_value' => 3.0],
            ['name' => 'Weight Lifting (Vigorous)', 'category' => 'Strength', 'met_value' => 6.0],
            ['name' => 'Yoga', 'category' => 'Flexibility', 'met_value' => 2.5],
            ['name' => 'Swimming', 'category' => 'Cardio', 'met_value' => 6.0],
            ['name' => 'HIIT', 'category' => 'Cardio', 'met_value' => 8.0],
            ['name' => 'Football (Soccer)', 'category' => 'Sports', 'met_value' => 7.0],
        ];
        foreach ($exercises as $ex) {
            \App\Models\Exercise::create($ex);
        }

        // Food Items
        $foods = [
            ['name' => 'Roti', 'category' => 'Staple', 'serving_size' => '1 piece (Medium)', 'calories' => 120],
            ['name' => 'Rice (Boiled)', 'category' => 'Staple', 'serving_size' => '1 cup', 'calories' => 205],
            ['name' => 'Chicken Biryani', 'category' => 'Main Course', 'serving_size' => '1 plate', 'calories' => 500],
            ['name' => 'Daal (Lentils)', 'category' => 'Main Course', 'serving_size' => '1 bowl', 'calories' => 150],
            ['name' => 'Apple', 'category' => 'Fruit', 'serving_size' => '1 medium', 'calories' => 95],
            ['name' => 'Banana', 'category' => 'Fruit', 'serving_size' => '1 medium', 'calories' => 105],
            ['name' => 'Milk', 'category' => 'Dairy', 'serving_size' => '1 glass', 'calories' => 150],
            ['name' => 'Egg (Boiled)', 'category' => 'Protein', 'serving_size' => '1 large', 'calories' => 78],
            ['name' => 'Paratha', 'category' => 'Staple', 'serving_size' => '1 piece', 'calories' => 290],
            ['name' => 'Chai (with sugar)', 'category' => 'Beverage', 'serving_size' => '1 cup', 'calories' => 120],
        ];
        foreach ($foods as $food) {
            \App\Models\FoodItem::create($food);
        }
    }
}
