<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | SmartCal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { margin: 0; padding: 0; background: #f8fafc; font-family: 'Outfit', sans-serif; }
        .split-layout { display: flex; min-height: 100vh; }
        .split-left { 
            flex: 1; 
            background: linear-gradient(135deg, rgba(248,250,252,0.1) 0%, rgba(248,250,252,0.4) 100%), url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=2000') center/cover no-repeat;
            display: flex; flex-direction: column; justify-content: flex-end; padding: 5rem;
            position: relative;
        }
        .split-left::after {
            content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); pointer-events: none;
        }
        .split-content { position: relative; z-index: 2; }
        .brand-logo { font-size: 2.5rem; font-weight: 800; color: #fff; text-decoration: none; font-family: 'Outfit', sans-serif; letter-spacing: -1px; margin-bottom: 2rem; display: inline-block; }
        .brand-logo span { color: #10b981; }
        .split-text h1 { font-family: 'Outfit'; font-size: 3.5rem; color: #fff; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -1px; }
        .split-text p { font-family: 'Outfit'; font-size: 1.25rem; color: #f1f5f9; line-height: 1.6; max-width: 500px; font-weight: 400; }
        
        .split-right { 
            flex: 1.2; display: flex; flex-direction: column; justify-content: center; align-items: center; 
            background: #f8fafc; position: relative; box-shadow: inset 10px 0 30px rgba(0,0,0,0.02); padding: 4rem 2rem;
        }
        .form-container { width: 100%; max-width: 700px; padding: 3.5rem; background: #ffffff; border-radius: 30px; box-shadow: 0 20px 50px rgba(16, 185, 129, 0.05); border: 1px solid #e2e8f0; }
        .form-header { margin-bottom: 2.5rem; text-align: left; }
        .form-header h2 { font-family: 'Outfit'; font-size: 2.2rem; color: #0f172a; font-weight: 800; margin-bottom: 0.5rem; }
        .form-header p { font-family: 'Outfit'; color: #64748b; font-size: 1.05rem; }
        
        .section-title { font-family: 'Outfit'; font-size: 1.4rem; color: #0f172a; font-weight: 800; margin: 2rem 0 1.5rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;}
        .section-title i { color: #10b981; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .form-group-full { grid-column: 1 / -1; }

        .auth-label { font-family: 'Outfit'; font-size: 0.85rem; color: #475569; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; display: block; font-weight: 700; }
        .auth-input, .auth-select { 
            width: 100%; padding: 1rem 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; 
            border-radius: 12px; color: #0f172a; font-family: 'Outfit'; font-size: 1rem; transition: 0.3s;
        }
        .auth-input:focus, .auth-select:focus { outline: none; border-color: #10b981; background: #ffffff; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        
        .radio-group { display: flex; gap: 1rem; }
        .radio-label { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; padding: 0.8rem 1.5rem; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; font-weight: 600; color: #475569; transition: 0.3s; flex: 1; justify-content: center;}
        .radio-label:hover { background: #fff; border-color: #cbd5e1; }
        .radio-label input[type="radio"] { accent-color: #10b981; width: 1.2rem; height: 1.2rem; cursor: pointer;}

        .auth-btn { 
            width: 100%; padding: 1.2rem; background: #10b981; margin-top: 2rem;
            color: white; border: none; border-radius: 12px; font-family: 'Outfit'; font-weight: 800; font-size: 1.1rem; 
            text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .auth-btn:hover { background: #059669; transform: translateY(-3px); box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); }
        
        .auth-footer { margin-top: 2rem; text-align: center; }
        .auth-footer a { color: #0f172a; text-decoration: none; font-family: 'Outfit'; font-weight: 700; font-size: 1rem; transition: 0.3s; }
        .auth-footer a span { color: #10b981; }
        .auth-footer a:hover span { color: #059669; }
        .back-home { display: inline-flex; align-items: center; margin-bottom: 2rem; color: #64748b; text-decoration: none; font-family: 'Outfit'; font-weight: 600; font-size: 0.95rem; transition: 0.3s; }
        .back-home:hover { color: #10b981; }

        @media (max-width: 900px) {
            .split-left { display: none; }
            .split-right { padding: 2rem 1rem; }
            .form-grid { grid-template-columns: 1fr; }
            .form-container { padding: 2rem; }
        }
    </style>
</head>
<body>
    <div class="split-layout">
        <!-- Visual Left Pane -->
        <div class="split-left">
            <div class="split-content">
                <a href="{{ route('index') }}" class="brand-logo"><span>Smart</span>Cal</a>
                <div class="split-text">
                    <h1>Join the Community. <br>Start your wellness log.</h1>
                    <p>Create a free account to track your daily nutrition, monitor hydration, and build sustainable healthy habits.</p>
                </div>
            </div>
        </div>

        <!-- Form Right Pane -->
        <div class="split-right">
            <div class="form-container">
                <a href="{{ route('index') }}" class="back-home"><i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Return to Site</a>
                <div class="form-header">
                    <h2>Create Your Free Account</h2>
                    <p>Enter your details below to get started.</p>
                </div>
                
                @if($errors->any())
                    <div style="color: #F44336; text-align: center; margin-bottom: 2rem; padding: 1rem; border: 1px solid rgba(244, 67, 54, 0.3); background: rgba(244, 67, 54, 0.1); border-radius: 8px; font-weight: 600; font-family: 'Outfit'; font-size: 0.95rem;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="section-title"><i class="fas fa-lock"></i> Account Details</div>
                    <div class="form-grid">
                        <div class="form-group-full">
                            <label class="auth-label">Full Name</label>
                            <input type="text" name="name" class="auth-input" placeholder="e.g. John Doe" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group-full">
                            <label class="auth-label">Email Address</label>
                            <input type="email" name="email" class="auth-input" placeholder="e.g. johndoe@example.com" required value="{{ old('email') }}">
                        </div>
                        <div>
                            <label class="auth-label">Password</label>
                            <input type="password" name="password" class="auth-input" placeholder="Enter your password" required>
                        </div>
                        <div>
                            <label class="auth-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="auth-input" placeholder="Repeat your password" required>
                        </div>
                    </div>

                    <div class="section-title"><i class="fas fa-user"></i> Profile Details</div>
                    <div class="form-grid">
                        <div class="form-group-full">
                            <label class="auth-label">Sex</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="male" required {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="female" required {{ old('gender') == 'female' ? 'checked' : '' }}> Female
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="auth-label">Age (Years)</label>
                            <input type="number" name="age" class="auth-input" placeholder="e.g. 25" required min="10" max="120" value="{{ old('age') }}">
                        </div>
                        <div>
                            <label class="auth-label">Height (cm)</label>
                            <input type="number" name="height_cm" class="auth-input" placeholder="e.g. 175" required min="50" max="300" value="{{ old('height_cm') }}">
                        </div>
                        <div>
                            <label class="auth-label">Weight (kg)</label>
                            <input type="number" step="0.1" name="weight_kg" class="auth-input" placeholder="e.g. 70.5" required min="20" max="300" value="{{ old('weight_kg') }}">
                        </div>
                        <div>
                            <label class="auth-label">Activity Level</label>
                            <select name="activity_level" class="auth-select" required>
                                <option value="sedentary" {{ old('activity_level') == 'sedentary' ? 'selected' : '' }}>Sedentary (Office Job)</option>
                                <option value="light" {{ old('activity_level') == 'light' ? 'selected' : '' }}>Lightly Active</option>
                                <option value="moderate" {{ old('activity_level') == 'moderate' ? 'selected' : '' }}>Moderately Active</option>
                                <option value="active" {{ old('activity_level') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="very_active" {{ old('activity_level') == 'very_active' ? 'selected' : '' }}>Very Active</option>
                            </select>
                        </div>
                        <div class="form-group-full">
                            <label class="auth-label">Primary Goal</label>
                            <select name="weight_goal" class="auth-select" required>
                                <option value="lose" {{ old('weight_goal') == 'lose' ? 'selected' : '' }}>Lose Weight (Caloric Deficit)</option>
                                <option value="maintain" {{ old('weight_goal') == 'maintain' ? 'selected' : '' }}>Maintain Weight</option>
                                <option value="gain" {{ old('weight_goal') == 'gain' ? 'selected' : '' }}>Gain Muscle (Caloric Surplus)</option>
                            </select>
                        </div>
                    </div>

                    <p style="text-align: center; color: #64748b; font-size: 0.9rem; margin-top: 2rem;">
                        By creating an account, you accept our <a href="{{ route('terms.service') }}" style="color: #10b981; text-decoration: none;">Terms of Service</a> & <a href="{{ route('privacy.policy') }}" style="color: #10b981; text-decoration: none;">Privacy Policy</a>.
                    </p>

                    <button type="submit" class="auth-btn">CREATE ACCOUNT</button>
                </form>
                
                <div class="auth-footer">
                    <p style="color: #64748b; font-family: 'Outfit'; font-size: 1rem;">
                        Already have an account? <a href="{{ route('login') }}"><span>Sign In here</span> →</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
