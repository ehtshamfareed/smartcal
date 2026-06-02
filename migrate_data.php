<?php
$old_db = new PDO('mysql:host=localhost;dbname=smartcal_db', 'root', '');
$new_db = new PDO('mysql:host=localhost;dbname=smartcal_laravel_db', 'root', '');

// Users
$users = $old_db->query("SELECT * FROM users WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
foreach($users as $user) {
    $check = $new_db->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$user['email']]);
    if(!$check->fetch()) {
        $stmt = $new_db->prepare("INSERT INTO users (name, email, password, role, age, gender, height_cm, weight_kg, activity_level, weight_goal, is_deleted, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([
            $user['name'], $user['email'], $user['password'], $user['role'],
            $user['age'], $user['gender'], $user['height_cm'], $user['weight_kg'],
            $user['activity_level'], $user['weight_goal'], $user['is_deleted']
        ]);
        $new_user_id = $new_db->lastInsertId();
        
        // Transfer related data for this user
        $logs = $old_db->prepare("SELECT * FROM daily_logs WHERE user_id = ? AND is_deleted=0");
        $logs->execute([$user['id']]);
        while($log = $logs->fetch(PDO::FETCH_ASSOC)) {
            $l_stmt = $new_db->prepare("INSERT INTO daily_logs (user_id, date, food_item_id, custom_food_name, meal_type, calories, is_deleted, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $l_stmt->execute([
                $new_user_id, $log['date'], $log['food_item_id'], 
                $log['custom_food_name'], $log['meal_type'], $log['calories'], $log['is_deleted']
            ]);
        }
        
        $w_logs = $old_db->prepare("SELECT * FROM water_logs WHERE user_id = ?");
        $w_logs->execute([$user['id']]);
        while($w_log = $w_logs->fetch(PDO::FETCH_ASSOC)) {
            $w_stmt = $new_db->prepare("INSERT INTO water_logs (user_id, date, glasses, daily_goal, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $w_stmt->execute([$new_user_id, $w_log['date'], $w_log['glasses'], $w_log['daily_goal']]);
        }

        $wt_logs = $old_db->prepare("SELECT * FROM weight_log WHERE user_id = ? AND is_deleted=0");
        $wt_logs->execute([$user['id']]);
        while($wt_log = $wt_logs->fetch(PDO::FETCH_ASSOC)) {
            $wt_stmt = $new_db->prepare("INSERT INTO weight_logs (user_id, date, weight_kg, is_deleted, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $wt_stmt->execute([$new_user_id, $wt_log['date'], $wt_log['weight_kg'], $wt_log['is_deleted']]);
        }
    }
}

// Food items
$foods = $old_db->query("SELECT * FROM food_items WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
foreach($foods as $food) {
    $check = $new_db->prepare("SELECT id FROM food_items WHERE name = ?");
    $check->execute([$food['name']]);
    if(!$check->fetch()) {
        $f_stmt = $new_db->prepare("INSERT INTO food_items (name, category, serving_size, calories, is_deleted, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        $f_stmt->execute([$food['name'], $food['category'], $food['serving_size'], $food['calories'], $food['is_deleted']]);
    }
}

// Exercises
$exer = $old_db->query("SELECT * FROM exercises WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
foreach($exer as $e) {
    $check = $new_db->prepare("SELECT id FROM exercises WHERE name = ?");
    $check->execute([$e['name']]);
    if(!$check->fetch()) {
        $e_stmt = $new_db->prepare("INSERT INTO exercises (name, category, met_value, is_deleted, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $e_stmt->execute([$e['name'], $e['category'], $e['met_value'], $e['is_deleted']]);
    }
}

echo "Migrate Script Executed Successfully." . PHP_EOL;
