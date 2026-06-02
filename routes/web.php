<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('dashboard');
    }

    // If no reviews exist, insert dummy ones with real Pakistani names
    if (\App\Models\Review::count() === 0) {
        $u1 = \App\Models\User::firstOrCreate(
            ['email' => 'ayesha@dummy.com'], 
            ['name' => 'Ayesha Khan', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 25, 'gender' => 'female', 'height_cm' => 160, 'weight_kg' => 60, 'activity_level' => 'moderate', 'weight_goal' => 'maintain']
        );
        $u2 = \App\Models\User::firstOrCreate(
            ['email' => 'bilal@dummy.com'], 
            ['name' => 'Bilal Ahmed', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 28, 'gender' => 'male', 'height_cm' => 175, 'weight_kg' => 75, 'activity_level' => 'active', 'weight_goal' => 'lose']
        );
        $u3 = \App\Models\User::firstOrCreate(
            ['email' => 'fatima@dummy.com'], 
            ['name' => 'Fatima Sheikh', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 26, 'gender' => 'female', 'height_cm' => 165, 'weight_kg' => 62, 'activity_level' => 'sedentary', 'weight_goal' => 'maintain']
        );

        \App\Models\Review::create(['user_id' => $u1->id, 'rating' => 5, 'review_text' => 'Before SmartCal, I was just eating healthily but had no idea my portions were too big. Seeing my actual calories helped me build a better relationship with my food.', 'is_approved' => 1]);
        \App\Models\Review::create(['user_id' => $u2->id, 'rating' => 4, 'review_text' => "Tracking what I eat shouldn't feel like a punishment. SmartCal's interface makes it feel like self-care. It's so easy to log my breakfast smoothies and dinner salads.", 'is_approved' => 1]);
        \App\Models\Review::create(['user_id' => $u3->id, 'rating' => 5, 'review_text' => "Cleanest UI I've ever used. The dashboard layout with the subtle aesthetics makes managing my daily hydration and nutrition inputs feel incredibly calming.", 'is_approved' => 1]);
    } else {
        // If they already exist and are linked to user 1 (System Admin), fix them
        $existingReviews = \App\Models\Review::orderBy('id')->get();
        if ($existingReviews->count() >= 3 && $existingReviews[0]->user_id === 1) {
            $u1 = \App\Models\User::firstOrCreate(
                ['email' => 'ayesha@dummy.com'], 
                ['name' => 'Ayesha Khan', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 25, 'gender' => 'female', 'height_cm' => 160, 'weight_kg' => 60, 'activity_level' => 'moderate', 'weight_goal' => 'maintain']
            );
            $u2 = \App\Models\User::firstOrCreate(
                ['email' => 'bilal@dummy.com'], 
                ['name' => 'Bilal Ahmed', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 28, 'gender' => 'male', 'height_cm' => 175, 'weight_kg' => 75, 'activity_level' => 'active', 'weight_goal' => 'lose']
            );
            $u3 = \App\Models\User::firstOrCreate(
                ['email' => 'fatima@dummy.com'], 
                ['name' => 'Fatima Sheikh', 'password' => bcrypt('password123'), 'role' => 'user', 'age' => 26, 'gender' => 'female', 'height_cm' => 165, 'weight_kg' => 62, 'activity_level' => 'sedentary', 'weight_goal' => 'maintain']
            );
            $existingReviews[0]->update(['user_id' => $u1->id]);
            $existingReviews[1]->update(['user_id' => $u2->id]);
            $existingReviews[2]->update(['user_id' => $u3->id]);
        }
    }
    
    $reviews = \App\Models\Review::with('user')->where('is_approved', 1)->get();
    return view('index', compact('reviews'));
})->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/water', [DashboardController::class, 'updateWater'])->name('dashboard.water');
    Route::post('/member/review', [DashboardController::class, 'storeReview'])->name('review.add');
    
    Route::get('/add-food', [FoodController::class, 'showAddFood'])->name('food.add');
    Route::post('/add-food', [FoodController::class, 'storeLog']);
    Route::post('/delete-food-log/{id}', [FoodController::class, 'deleteLog'])->name('food.delete');
    
    Route::get('/add-workout', [WorkoutController::class, 'showAddWorkout'])->name('workout.add');
    Route::post('/add-workout', [WorkoutController::class, 'storeLog']);
    Route::post('/delete-workout-log/{id}', [WorkoutController::class, 'deleteLog'])->name('workout.delete');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);
});

Route::view('/dietary-guidelines', 'pages.dietary_guidelines')->name('dietary.guidelines');
Route::view('/privacy-policy', 'pages.privacy_policy')->name('privacy.policy');
Route::view('/terms-of-service', 'pages.terms_of_service')->name('terms.service');
Route::view('/platform-features', 'pages.platform_features')->name('platform.features');
Route::view('/how-it-works', 'pages.how_it_works')->name('how.it.works');
Route::view('/success-stories', 'pages.success_stories')->name('success.stories');
Route::view('/blog', 'pages.blogs')->name('blogs');

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::get('/foods', [AdminController::class, 'foods'])->name('foods');
    Route::get('/foods/add', [AdminController::class, 'showAddFood'])->name('food.add.show');
    Route::post('/foods', [AdminController::class, 'storeFood'])->name('food.add');
    Route::post('/foods/delete/{id}', [AdminController::class, 'deleteFood'])->name('food.delete');

    Route::get('/exercises', [AdminController::class, 'exercises'])->name('exercises');
    Route::get('/exercises/add', [AdminController::class, 'showAddExercise'])->name('exercise.add.show');
    Route::post('/exercises', [AdminController::class, 'storeExercise'])->name('exercise.add');
    Route::post('/exercises/delete/{id}', [AdminController::class, 'deleteExercise'])->name('exercise.delete');

    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/approve/{id}', [AdminController::class, 'approveReview'])->name('review.approve');
    Route::post('/reviews/delete/{id}', [AdminController::class, 'deleteReview'])->name('review.delete');

    Route::get('/user-logs/{id}', [AdminController::class, 'userLogs'])->name('user.logs');
});
