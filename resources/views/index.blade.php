<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCal | The Ultimate Calorie & Macro Engine</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Fresh Wellness Landing Page Styles */
        body { background: #f8fafc; color: #1e293b; overflow-x: hidden; font-family: 'Outfit', sans-serif; scroll-behavior: smooth; }
        
        /* Navbar */
        .top-nav {
            position: fixed; width: 100%; top: 0; z-index: 1000;
            background: transparent; 
            padding: 1.5rem 0; transition: all 0.4s ease;
        }
        .top-nav.scrolled {
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);
            padding: 0.8rem 0; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 2rem; }
        .logo { font-size: 2.2rem; font-weight: 800; color: #0f172a; text-decoration: none; font-family: 'Outfit', sans-serif; letter-spacing: -1.5px; display: flex; align-items: center; gap: 0.3rem;}
        .logo i { color: #10b981; font-size: 1.8rem; }
        .logo span { color: #10b981; }
        .nav-links a { color: #475569; text-decoration: none; margin-left: 2rem; font-weight: 600; font-size: 0.95rem; font-family: 'Outfit'; transition: 0.3s; }
        .nav-links a:hover { color: #10b981; }
        .nav-links a.nav-btn { background: #10b981; color: #fff !important; padding: 12px 30px; border-radius: 50px; font-weight: 800; font-size: 14px; margin-left: 2.5rem; border: none; transition: 0.3s; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); text-transform: uppercase; letter-spacing: 1px; display: inline-flex; align-items: center; justify-content: center; white-space: nowrap; }
        .nav-links a.nav-btn:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); color: #fff; }

        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        @keyframes slide {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        @keyframes slide-reverse {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0%); }
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* Hero */
        .hero { 
            position: relative; min-height: 100vh; display: flex; align-items: center; padding-top: 120px;
            background: radial-gradient(circle at 80% 50%, rgba(16,185,129,0.08) 0%, rgba(248,250,252,1) 50%);
            overflow: hidden;
        }
        .hero-container { max-width: 1400px; width: 100%; padding: 0 2rem; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
        
        .hero-text-wrapper { max-width: 650px; z-index: 2;}
        .hero-badge {
            display: inline-block; padding: 0.5rem 1.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 50px; font-family: 'Outfit'; color: #10b981; font-size: 0.9rem; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; margin-bottom: 2rem;
        }
        .hero-badge i { color: #10b981; margin-right: 0.5rem; }
        .hero h1 { font-size: 4.5rem; color: #0f172a; font-weight: 800; font-family: 'Outfit'; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -2px; }
        .hero h1 span { color: #10b981; } 
        .hero p { font-size: 1.25rem; color: #475569; line-height: 1.6; font-family: 'Outfit'; font-weight: 400; margin-bottom: 3rem; }
        
        .cta-group { display: flex; gap: 1rem; justify-content: flex-start; }
        .btn-large { padding: 1.2rem 3rem; font-size: 1.1rem; border-radius: 50px; text-decoration: none; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #fff; background: #10b981; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: 0.3s; display: inline-block; }
        .btn-large:hover { background: #059669; transform: translateY(-3px); box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); }

        /* Floating Hero Images (Cronometer style) */
        .hero-images { position: relative; width: 100%; height: 600px; display: flex; justify-content: center; align-items: center; }
        .floating-card { position: absolute; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.8); overflow: hidden; background: #fff;}
        .floating-card img { display: block; max-width: 100%; height: auto; }
        
        .card-1 { width: 320px; z-index: 3; animation: float 6s ease-in-out infinite; left: 10%; top: 15%; }
        .card-2 { width: 280px; z-index: 2; animation: float 8s ease-in-out infinite reverse; right: 5%; top: 5%; }
        .card-3 { width: 260px; z-index: 4; animation: float 7s ease-in-out infinite; right: 15%; bottom: 10%; }

        /* Marquee Section */
        .marquee-section { padding: 3rem 0; background: #fff; border-bottom: 1px solid #e2e8f0; border-top: 1px solid #e2e8f0; overflow: hidden; position: relative;}
        .marquee-title { text-align: center; color: #64748b; font-size: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem; font-family: 'Outfit'; }
        .marquee-container { width: 100%; overflow: hidden; white-space: nowrap; position: relative; }
        .marquee-track { display: inline-flex; white-space: nowrap; animation: slide 20s linear infinite; }
        .marquee-track-reverse { display: inline-flex; white-space: nowrap; animation: slide-reverse 20s linear infinite; }
        .marquee-item { display: inline-flex; align-items: center; justify-content: center; width: 200px; margin: 0 2rem; color: #94a3b8; font-size: 2rem; opacity: 0.6; transition: 0.3s; }
        .marquee-item:hover { opacity: 1; color: #10b981; }

        /* Alternating Rows (Cronometer Style) */
        .section { padding: 6rem 2rem; }
        .section-header { text-align: center; margin-bottom: 5rem; }
        .section-header h2 { font-size: 3rem; font-family: 'Outfit'; font-weight: 800; color: #0f172a; margin-bottom: 1rem; }
        .section-header p { font-size: 1.15rem; color: #64748b; font-family: 'Outfit'; max-width: 600px; margin: 0 auto; line-height: 1.6;}

        .alt-row { display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; max-width: 1200px; margin: 0 auto 6rem; align-items: center; }
        .alt-row.reverse { grid-template-columns: 1fr 1fr; direction: rtl; }
        .alt-row.reverse > * { direction: ltr; }
        
        .alt-text { padding: 2rem 0; }
        .alt-text h3 { font-size: 2.5rem; color: #0f172a; font-family: 'Outfit'; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.2; }
        .alt-text p { font-size: 1.15rem; color: #475569; font-family: 'Outfit'; line-height: 1.7; }
        
        .alt-img { position: relative; border-radius: 30px; box-shadow: 0 30px 60px rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.1); overflow: hidden; }
        .alt-img::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(16,185,129,0.05); z-index: 1; pointer-events: none; }
        .alt-img img { width: 100%; display: block; transition: 0.5s; }
        .alt-img:hover img { transform: scale(1.03); }

        /* Reviews */
        .reviews-bg { background: #f8fafc; border-top: 1px solid rgba(0,0,0,0.05); overflow: hidden; }
        .reviews-marquee-container { width: 100%; overflow: hidden; white-space: nowrap; position: relative; padding: 1rem 0; }
        .reviews-marquee-track { display: inline-flex; white-space: nowrap; animation: slide 30s linear infinite; gap: 2rem; padding: 1rem 2rem; }
        .reviews-marquee-track:hover { animation-play-state: paused; }
        .review-card { background: #ffffff; border: 1px solid rgba(0,0,0,0.05); padding: 2.5rem; border-radius: 20px; transition: 0.3s; display: inline-block; white-space: normal; width: 400px; vertical-align: top; }
        .review-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.05); transform: translateY(-5px); }
        .review-stars { color: #f59e0b; margin-bottom: 1.5rem; font-size: 1.2rem; }
        .review-text { font-family: 'Outfit'; color: #334155; font-size: 1.15rem; line-height: 1.6; font-style: italic; margin-bottom: 2rem; }
        .reviewer { display: flex; align-items: center; gap: 1rem; }
        .r-avatar { width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; background-size: cover; background-position: center; }
        .r-info h4 { font-family: 'Outfit'; color: #0f172a; font-size: 1.1rem; margin-bottom: 0.2rem; font-weight: 700; }
        .r-info p { font-family: 'Outfit'; color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;}

        /* Footer */
        .footer { background: #f8fafc; padding: 6rem 2rem 2rem; position: relative; overflow: hidden; margin-top: 4rem; }
        .footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; background: #10b981; }
        .footer-grid { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .footer h2 { font-family: 'Outfit'; font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -1.5px; display: flex; align-items: center; gap: 0.5rem;}
        .footer h2 i { color: #10b981; font-size: 1.6rem; background: rgba(16, 185, 129, 0.1); padding: 8px; border-radius: 10px; }
        .footer h2 span { color: #10b981; }
        .footer p { color: #64748b; font-family: 'Outfit'; line-height: 1.6; font-size: 0.95rem; margin-bottom: 1rem; }
        .footer h3 { color: #0f172a; font-family: 'Outfit'; font-size: 1rem; margin-bottom: 1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; }
        .footer h3 i { color: #10b981; margin-right: 0.5rem; font-size: 1.2rem; }
        .footer ul { list-style: none; padding: 0; margin: 0; }
        .footer ul li { margin-bottom: 0.7rem; }
        .footer ul li a { text-decoration: none; transition: 0.3s; font-weight: 600; color: #64748b; font-family: 'Outfit'; display: inline-flex; align-items: center; }
        .footer ul li a::before { content: '→'; opacity: 0; margin-right: -15px; color: #10b981; transition: 0.3s; font-weight: bold; }
        .footer ul li a:hover { color: #10b981; transform: translateX(5px); }
        .footer ul li a:hover::before { opacity: 1; margin-right: 8px; }
        
        .newsletter-box { display: flex; background: #fff; padding: 5px; border-radius: 50px; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: 0.3s; }
        .newsletter-box:focus-within { border-color: #10b981; box-shadow: 0 4px 20px rgba(16, 185, 129, 0.1); }
        .newsletter-box input { flex: 1; border: none; padding: 0.8rem 1.5rem; font-family: 'Outfit'; font-size: 0.95rem; border-radius: 50px; outline: none; color: #0f172a; }
        .newsletter-box button { background: #10b981; color: #fff; border: none; padding: 0.8rem 1.5rem; border-radius: 50px; font-weight: 700; font-family: 'Outfit'; cursor: pointer; transition: 0.3s; }
        .newsletter-box button:hover { background: #059669; }

        .footer-bottom { max-width: 1400px; margin: 0 auto; border-top: 1px solid #cbd5e1; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-bottom p { margin: 0; font-size: 0.95rem; font-weight: 600; color: #94a3b8; }
        .footer-socials { display: flex; gap: 1rem; }
        .footer-socials a { font-size: 1.2rem; color: #94a3b8; background: #fff; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; border-radius: 50%; border: 1px solid #e2e8f0; transition: 0.3s; }
        .footer-socials a:hover { color: #fff; background: #10b981; border-color: #10b981; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3); }

        /* Fan Cards Section */
        .fan-section { padding: 8rem 2rem; text-align: center; background: #fff; overflow: hidden; border-bottom: 1px solid #e2e8f0; }
        .fan-section h2 { font-size: 2.8rem; font-family: 'Outfit'; font-weight: 800; color: #0f172a; max-width: 800px; margin: 0 auto 2rem; line-height: 1.2; }
        .fan-cta { background: #f59e0b; color: #fff; padding: 1.2rem 3rem; border-radius: 50px; font-family: 'Outfit'; font-weight: 800; font-size: 1.1rem; text-decoration: none; display: inline-block; transition: 0.3s; margin-bottom: 6rem; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }
        .fan-cta:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4); background: #f09300; }
        
        .fan-container { position: relative; height: 480px; max-width: 1200px; margin: 0 auto; display: flex; justify-content: center; align-items: flex-end; perspective: 1000px; }
        .fan-card-wrapper { position: absolute; bottom: 0; z-index: 1; transition: z-index 0s 0.2s; }
        .fan-card-wrapper:hover { z-index: 100 !important; transition: z-index 0s 0s; }
        .fan-card { width: 280px; height: 450px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); overflow: hidden; transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); transform-origin: bottom center; cursor: pointer; display: flex; flex-direction: column; transform: translateY(0) scale(1); }
        .fan-card-wrapper:hover .fan-card { transform: translateY(-40px) scale(1.08); box-shadow: 0 40px 80px rgba(0,0,0,0.3); }
        .fan-img { flex: 1; background-size: cover; background-position: center; }
        .fan-text { padding: 1.5rem; color: #fff; font-family: 'Outfit'; font-weight: 700; font-size: 1.1rem; text-align: center; line-height: 1.4; display: flex; align-items: center; justify-content: center; height: 100px; }
        
        .fcw-1 { transform: translateX(-240px) rotate(-12deg) scale(0.85); z-index: 1; }
        .fcw-2 { transform: translateX(-120px) rotate(-6deg) scale(0.92); z-index: 2; }
        .fcw-3 { transform: translateX(0) scale(1.0); z-index: 5; }
        .fcw-3 .fan-card { height: 480px; }
        .fcw-4 { transform: translateX(120px) rotate(6deg) scale(0.92); z-index: 2; }
        .fcw-5 { transform: translateX(240px) rotate(12deg) scale(0.85); z-index: 1; }
        
        @media (max-width: 1024px) {
            .fan-container { height: auto; flex-direction: column; align-items: center; gap: 2rem; position: static; }
            .fan-card-wrapper { position: relative; transform: none !important; width: 100%; max-width: 320px; }
            .fan-card { height: 400px; width: 100%; }
            .fcw-3 .fan-card { height: 400px; }
        }

        /* Feature Highlights */
        .features-highlights { padding: 4rem 2rem; background: #fff; border-bottom: 1px solid #e2e8f0; }
        .features-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .feature-box { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: 0.3s; }
        .feature-box:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .feature-box i { color: #0f766e; font-size: 1.5rem; margin-bottom: 1rem; }
        .feature-box h3 { font-size: 1.25rem; color: #0f172a; margin-bottom: 1rem; font-weight: 700; font-family: 'Outfit'; }
        .feature-box p { color: #475569; line-height: 1.6; font-size: 0.95rem; margin: 0; }

        /* Help Section */
        .help-section { padding: 6rem 2rem; background: #fff8f0; }
        .help-header { text-align: center; margin-bottom: 4rem; }
        .help-header h2 { font-size: 3rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem; font-family: 'Outfit'; }
        .help-header p { color: #475569; font-size: 1.1rem; }
        .help-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .help-card { background: #fff; border-radius: 16px; overflow: hidden; display: flex; flex-direction: column; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .help-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .help-content { padding: 2rem 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .help-content h3 { font-size: 1.1rem; color: #0f172a; font-weight: 700; margin-bottom: 1.5rem; line-height: 1.4; font-family: 'Outfit'; }
        .help-content i { color: #0f172a; font-size: 1.2rem; }
        .help-card img { width: 100%; height: 160px; object-fit: cover; }

        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .hero-container, .alt-row { grid-template-columns: 1fr; gap: 2rem; }
            .hero h1 { font-size: 3.5rem; }
            .alt-row.reverse { direction: ltr; }
            .hero-images { display: none; } /* Hide complex animations on mobile for performance */
            .help-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .nav-links { display: none; }
        }
        @media (max-width: 600px) {
            .help-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
            <a href="{{ route('index') }}" class="logo"><i class="fas fa-leaf"></i> <span>Smart</span>Cal</a>
            <div class="nav-links">
                <a href="{{ route('platform.features') }}">Features</a>
                <a href="{{ route('how.it.works') }}">How it Works</a>
                <a href="{{ route('success.stories') }}">Success Stories</a>
                <a href="{{ route('blogs') }}">Blog</a>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-btn">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="nav-btn">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-container">
            <div class="hero-text-wrapper reveal active">
                <div class="hero-badge">
                    <i class="fas fa-microscope"></i> SCIENCE-BACKED NUTRITION
                </div>
                <h1>Nutrition tracking <br>at your <span>fingertips.</span></h1>
                <p>From macros to micros, SmartCal gives you personalized insight into your diet, exercise, and health data so you can make more informed decisions.</p>
                <div class="cta-group">
                    <a href="{{ route('register') }}" class="btn-large">SIGN UP FOR FREE</a>
                </div>
            </div>
            <div class="hero-images">
                <!-- Conceptual Floating Images inspired by Cronometer's cards -->
                <div class="floating-card card-1"><img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=600" alt="Food tracking" onerror="this.src='https://via.placeholder.com/600x400/10b981/ffffff?text=Food+Tracking'"></div>
                <div class="floating-card card-2"><img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=600" alt="Healthy habits" onerror="this.src='https://via.placeholder.com/600x400/0f172a/ffffff?text=Healthy+Habits'"></div>
                <div class="floating-card card-3"><img src="https://images.unsplash.com/photo-1498837167922-41c53b4f094b?auto=format&fit=crop&q=80&w=600" alt="Nutrition stats" onerror="this.src='https://via.placeholder.com/600x400/f8fafc/10b981?text=Nutrition+Stats'"></div>
            </div>
        </div>
    </header>

    <!-- Feature Highlights Section -->
    <section class="features-highlights">
        <div class="features-grid reveal">
            <div class="feature-box">
                <i class="fas fa-check-circle"></i>
                <h3>Log your food and exercise</h3>
                <p>Easily add food by using our free Barcode Scanner or select from a database of over 1M verified foods.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-check-circle"></i>
                <h3>Get a detailed nutrition snapshot</h3>
                <p>From fat to protein to carbs, access personalized nutrition charts and dashboards to get a complete picture of your health.</p>
            </div>
            <div class="feature-box">
                <i class="fas fa-check-circle"></i>
                <h3>Build healthy habits that last</h3>
                <p>Get off the dieting yo-yo with data that builds momentum toward your long-term goals.</p>
            </div>
        </div>
    </section>

    <!-- Help Section -->
    <section class="help-section">
        <div class="help-header reveal">
            <h2>How can we help?</h2>
            <p>I want to use SmartCal to...</p>
        </div>
        <div class="help-grid reveal">
            <div class="help-card">
                <div class="help-content">
                    <h3>Keep track of my food intake</h3>
                    <i class="fas fa-arrow-right"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=400" alt="Track food">
            </div>
            <div class="help-card">
                <div class="help-content">
                    <h3>Monitor my health metrics</h3>
                    <i class="fas fa-arrow-right"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&q=80&w=400" alt="Health metrics">
            </div>
            <div class="help-card">
                <div class="help-content">
                    <h3>Optimize and refine my diet</h3>
                    <i class="fas fa-arrow-right"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?auto=format&fit=crop&q=80&w=400" alt="Optimize diet">
            </div>
            <div class="help-card">
                <div class="help-content">
                    <h3>Analyze my diet progress</h3>
                    <i class="fas fa-arrow-right"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?auto=format&fit=crop&q=80&w=400" alt="Analyze progress">
            </div>
        </div>
    </section>


    <!-- Trusted By / As Seen In Marquee -->
    <section class="marquee-section">
        <h4 class="marquee-title">Trusted & Integrated With</h4>
        <div class="marquee-container">
            <div class="marquee-track">
                <span class="marquee-item"><i class="fab fa-apple"></i>&nbsp;Apple Health</span>
                <span class="marquee-item"><i class="fab fa-google"></i>&nbsp;Google Fit</span>
                <span class="marquee-item"><i class="fas fa-heartbeat"></i>&nbsp;Fitbit</span>
                <span class="marquee-item"><i class="fas fa-running"></i>&nbsp;Garmin</span>
                <span class="marquee-item"><i class="fas fa-ring"></i>&nbsp;Oura</span>
                <!-- Repeat for infinite loop illusion -->
                <span class="marquee-item"><i class="fab fa-apple"></i>&nbsp;Apple Health</span>
                <span class="marquee-item"><i class="fab fa-google"></i>&nbsp;Google Fit</span>
                <span class="marquee-item"><i class="fas fa-heartbeat"></i>&nbsp;Fitbit</span>
                <span class="marquee-item"><i class="fas fa-running"></i>&nbsp;Garmin</span>
                <span class="marquee-item"><i class="fas fa-ring"></i>&nbsp;Oura</span>
                <span class="marquee-item"><i class="fab fa-apple"></i>&nbsp;Apple Health</span>
                <span class="marquee-item"><i class="fab fa-google"></i>&nbsp;Google Fit</span>
            </div>
        </div>
    </section>

    <!-- Fan Cards Section replacing old Why Use Section -->
    <section class="fan-section">
        <h2 class="reveal">If you count calories, macros, or micronutrients, you can count on us</h2>
        <a href="{{ route('register') }}" class="fan-cta reveal">Sign Up For Free</a>
        
        <div class="fan-container reveal">
            <div class="fan-card-wrapper fcw-1">
                <div class="fan-card" style="background: #064e3b;">
                    <div class="fan-img" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=400');"></div>
                    <div class="fan-text">Reach & maintain your goal weight</div>
                </div>
            </div>
            <div class="fan-card-wrapper fcw-2">
                <div class="fan-card" style="background: #fbbf24;">
                    <div class="fan-img" style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=400');"></div>
                    <div class="fan-text">Sync with your devices</div>
                </div>
            </div>
            <div class="fan-card-wrapper fcw-3">
                <div class="fan-card" style="background: #ff6b35;">
                    <div class="fan-img" style="background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=400');"></div>
                    <div class="fan-text">Develop healthy habits</div>
                </div>
            </div>
            <div class="fan-card-wrapper fcw-4">
                <div class="fan-card" style="background: #1e293b;">
                    <div class="fan-img" style="background-image: url('https://images.unsplash.com/photo-1498837167922-41c53b4f094b?auto=format&fit=crop&q=80&w=400');"></div>
                    <div class="fan-text">Dial up your diet</div>
                </div>
            </div>
            <div class="fan-card-wrapper fcw-5">
                <div class="fan-card" style="background: #38bdf8;">
                    <div class="fan-img" style="background-image: url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&q=80&w=400');"></div>
                    <div class="fan-text">Get a holistic view of your health</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section reviews-bg">
        <div class="section-header reveal">
            <h2>Success Stories</h2>
            <p>Join thousands of members who took control of their caloric data.</p>
        </div>
        <div class="reviews-marquee-container">
            <div class="reviews-marquee-track">
                @if(isset($reviews) && $reviews->isNotEmpty())
                    @for($k=1; $k<=2; $k++)
                        @foreach($reviews as $review)
                        <div class="review-card">
                            <div class="review-stars">
                                @for($i=1; $i<=5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star" style="color: #cbd5e1;"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="review-text">"{{ $review->review_text }}"</div>
                            <div class="reviewer">
                                <div class="r-avatar" style="background-color: #e2e8f0; display:flex; align-items:center; justify-content:center; color:#64748b; font-size:1.5rem; font-weight:bold; min-width: 50px;">
                                    {{ strtoupper(substr($review->user->name ?? 'User', 0, 1)) }}
                                </div>
                                <div class="r-info">
                                    <h4>{{ $review->user->name ?? 'User' }}</h4>
                                    <p>SmartCal Member</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endfor
                @else
                    <p style="text-align: center; color: #64748b; width: 100%; display: block; white-space: normal;">More success stories coming soon...</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <h2><i class="fas fa-leaf"></i> <span>Smart</span>Cal</h2>
                <p>A beautifully designed tool to help you understand your nutrition, track your meals, and cultivate sustainable lifestyle habits without feeling restrictive. Your journey to wellness starts here.</p>
                <p style="font-weight: 600; color: #475569;"><i class="fas fa-map-marker-alt" style="color: #10b981; margin-right: 8px;"></i> 123 Health Avenue, Wellness City</p>
                <p style="font-weight: 600; color: #475569;"><i class="fas fa-envelope" style="color: #10b981; margin-right: 8px;"></i> support@smartcal.health</p>
            </div>
            <div>
                <h3><i class="fas fa-compass"></i> Navigation</h3>
                <ul>
                    <li><a href="{{ route('platform.features') }}">Platform Features</a></li>
                    <li><a href="{{ route('how.it.works') }}">How It Works</a></li>
                    <li><a href="{{ route('success.stories') }}">Success Stories</a></li>
                    <li><a href="{{ route('dietary.guidelines') }}">Dietary Guidelines</a></li>
                    <li><a href="{{ route('blogs') }}">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3><i class="fas fa-user-circle"></i> Member Area</h3>
                <ul>
                    <li><a href="{{ route('register') }}">Create Account</a></li>
                    <li><a href="{{ route('login') }}">Member Login</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms.service') }}">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h3><i class="fas fa-paper-plane"></i> Wellness Newsletter</h3>
                <p style="font-size: 0.95rem; margin-bottom: 1rem;">Join 10,000+ members receiving weekly nutritional tips and macro-friendly recipes directly in their inbox.</p>
                <form class="newsletter-box" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Join</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date("Y") }} SmartCal Inc. Crafted for Health.</p>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.top-nav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Scroll Reveal Animation
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal(); // Initial check
    </script>
</body>
</html>
