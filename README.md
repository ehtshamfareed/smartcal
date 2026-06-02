# SmartCal - Fitness & Calorie Tracker

SmartCal is a web-based fitness and calorie tracking application built with Laravel. It allows users to track their daily food intake, water consumption, and workout routines, while providing administrators with tools to manage users and the food database.

## 🚀 Features Implemented (Working)

### 1. Authentication System
- User Registration & Login
- Secure Logout

### 2. User Dashboard
- Main dashboard to view daily progress and statistics.
- **Water Tracking:** Track daily water intake.

### 3. Diet / Food Tracking
- Add food logs to track daily calorie intake.
- Delete food logs if entered incorrectly.
- **Smart Food Guidance:** Dynamic UI badges (Recommended / Not Recommended / Bulking) indicating whether a food aligns with the user's current weight goal.
- **Smart Warnings:** Real-time form interception that warns users if they attempt to log a food that contradicts their weight loss targets.

### 4. Workout Tracking
- Add workout routines and exercises.
- Delete workout logs.

### 5. Profile Management
- Users can view and update their profile details.
- **Goal Setting:** Users can set specific weight loss/gain targets (Deficit, Maintenance, Surplus) which recalibrates their metabolic targets.

### 6. Advanced Dashboard & Reports
- **Macro-nutrient Breakdown:** Detailed real-time tracking of Carbs, Fats, and Proteins.
- **Advanced Analytics & Charts:** Visual graphs for weekly and monthly progress, alongside detailed nutrition reports.

### 7. User Review System (New)
- **Member Dashboard Integration:** Users can submit success stories and ratings directly from their dashboard.
- **Admin Moderation:** Admins can view, approve, or delete pending reviews before they are published.
- **Dynamic Showcase:** Approved reviews are seamlessly displayed on the landing page using a continuous horizontal scrolling (marquee) animation.

### 8. Admin Panel (Role-based access)
- Admin Dashboard for platform overview.
- **User Management:** View all registered users and delete users if necessary.
- **Food Database Management:** Add new food items to the global database and delete existing ones.
- **Diet Suitability Tags:** Assign specific goal-based tags (Weight Loss, Weight Gain, Universal) to global foods.
- **Exercise Database Management:** Manage a global database of exercises and their corresponding MET values.
- **Member Reviews Management:** Approve and moderate user-submitted success stories.
- **User Logs:** View detailed activity and logs of specific users.

### 9. Legal & Compliance
- Comprehensive, professionally structured Privacy Policy.
- Detailed Terms of Service guidelines.

---

## ⏳ Pending Features (To-Do)

- [ ] **Password Reset / Forgot Password:** Allow users to recover their accounts via email.
- [ ] **Email Verification:** Verify user email addresses upon registration.

## 🛠️ Tech Stack
- **Framework:** Laravel (PHP)
- **Frontend:** Blade Templates, HTML, CSS
- **Database:** MySQL

## ⚙️ Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan key:generate`
5. Run migrations: `php artisan migrate` (Alternatively, you can import the `smartcal_laravel_db.sql` or use `migrate_data.php`)
6. Start the development server: `php artisan serve`
