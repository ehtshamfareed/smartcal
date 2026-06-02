<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login | SmartCal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { margin: 0; padding: 0; background: #f8fafc; font-family: 'Outfit', sans-serif; }
        .split-layout { display: flex; min-height: 100vh; }
        .split-left { 
            flex: 1.2; 
            background: linear-gradient(135deg, rgba(248,250,252,0.1) 0%, rgba(248,250,252,0.4) 100%), url('https://images.unsplash.com/photo-1494390248081-4e521a5940db?auto=format&fit=crop&q=80&w=2000') center/cover no-repeat;
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
            flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; 
            background: #f8fafc; position: relative; box-shadow: inset 10px 0 30px rgba(0,0,0,0.02);
        }
        .form-container { width: 100%; max-width: 480px; padding: 3.5rem; background: #ffffff; border-radius: 30px; box-shadow: 0 20px 50px rgba(16, 185, 129, 0.05); border: 1px solid #e2e8f0; }
        .form-header { margin-bottom: 3rem; text-align: left; }
        .form-header h2 { font-family: 'Outfit'; font-size: 2.5rem; color: #0f172a; font-weight: 800; margin-bottom: 0.5rem; }
        .form-header p { font-family: 'Outfit'; color: #64748b; font-size: 1.1rem; }
        .auth-label { font-family: 'Outfit'; font-size: 0.85rem; color: #475569; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; display: block; font-weight: 700; }
        .auth-input { 
            width: 100%; padding: 1.2rem 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; 
            border-radius: 12px; color: #0f172a; font-family: 'Outfit'; font-size: 1rem; margin-bottom: 1.5rem; transition: 0.3s;
        }
        .auth-input:focus { outline: none; border-color: #10b981; background: #ffffff; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        .auth-btn { 
            width: 100%; padding: 1.2rem; background: #10b981; 
            color: white; border: none; border-radius: 12px; font-family: 'Outfit'; font-weight: 800; font-size: 1rem; 
            text-transform: uppercase; letter-spacing: 1.5px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .auth-btn:hover { background: #059669; transform: translateY(-3px); box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); }
        .auth-footer { margin-top: 2rem; text-align: left; }
        .auth-footer a { color: #0f172a; text-decoration: none; font-family: 'Outfit'; font-weight: 700; font-size: 1rem; transition: 0.3s; }
        .auth-footer a span { color: #10b981; }
        .auth-footer a:hover span { color: #059669; }
        .back-home { display: inline-flex; align-items: center; margin-bottom: 2rem; color: #64748b; text-decoration: none; font-family: 'Outfit'; font-weight: 600; font-size: 0.95rem; transition: 0.3s; }
        .back-home:hover { color: #10b981; }

        @media (max-width: 900px) {
            .split-left { display: none; }
            .split-right { padding: 2rem; }
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
                    <h1>Welcome Back. <br>Your journey continues.</h1>
                    <p>Log in to access your customized nutrition log, review your daily meals, and stay mindful of your lifestyle habits.</p>
                </div>
            </div>
        </div>

        <!-- Form Right Pane -->
        <div class="split-right">
            <div class="form-container">
                <a href="{{ route('index') }}" class="back-home"><i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Return to Site</a>
                <div class="form-header">
                    <h2>Member Login</h2>
                    <p>Enter your account details below.</p>
                </div>
                
                @if($errors->any())
                    <div style="color: #F44336; text-align: center; margin-bottom: 2rem; padding: 1rem; border: 1px solid rgba(244, 67, 54, 0.3); background: rgba(244, 67, 54, 0.1); border-radius: 8px; font-weight: 600; font-family: 'Outfit'; font-size: 0.95rem;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class="auth-label">Email Address</label>
                        <input type="email" name="email" class="auth-input" placeholder="e.g. johndoe@example.com" required value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="auth-label">Password</label>
                        <input type="password" name="password" class="auth-input" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="auth-btn" style="margin-top: 1rem;">SIGN IN</button>
                </form>
                
                <div class="auth-footer">
                    <p style="color: #64748b; font-family: 'Outfit'; font-size: 1rem;">
                        Don't have an account? <br><a href="{{ route('register') }}" style="display:inline-block; margin-top:0.5rem; color: #0f172a; text-decoration: none; font-weight: 700;"><span>Create one completely free</span> →</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
