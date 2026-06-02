<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=3" type="image/png">
    <title>Dietary Guidelines | SmartCal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Shared Styles */
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
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        /* Page Hero */
        .page-hero { 
            position: relative; padding: 160px 0 80px; 
            background: radial-gradient(circle at top right, rgba(16,185,129,0.1) 0%, rgba(248,250,252,1) 60%);
            text-align: center; border-bottom: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .page-hero h1 { font-size: 3.5rem; font-family: 'Outfit'; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -1px;}
        .page-hero p { font-size: 1.2rem; color: #64748b; max-width: 600px; margin: 0 auto; line-height: 1.6;}
        .page-hero-img { position: absolute; right: 5%; top: 20%; width: 300px; opacity: 0.3; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transform: rotate(5deg); pointer-events: none;}
        .page-hero-img-left { position: absolute; left: 5%; bottom: -10%; width: 250px; opacity: 0.3; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transform: rotate(-5deg); pointer-events: none;}
        /* Content Container */
        .content-wrap { max-width: 1000px; margin: 4rem auto; padding: 0 2rem; }
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;}
        .info-card { background: #fff; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; }
        .info-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.3);}
        .info-card i { font-size: 2.5rem; color: #10b981; margin-bottom: 1.5rem; display: block;}
        .info-card h3 { font-size: 1.4rem; color: #0f172a; font-family: 'Outfit'; font-weight: 800; margin-bottom: 1rem;}
        .info-card p { color: #475569; line-height: 1.6; font-size: 1rem; }
        /* Plain Text Format */
        .text-content { background: #fff; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
        .text-content h3 { font-family: 'Outfit'; font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: #0f172a; font-weight: 800;}
        .text-content p, .text-content ul { font-size: 1.05rem; line-height: 1.8; color: #475569; margin-bottom: 1.5rem; }
        .text-content ul { padding-left: 1.5rem; }
        .text-content li { margin-bottom: 0.5rem; }
        /* Footer */
        .footer { background: linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%); padding: 2rem 2rem 1rem; border-top: 1px solid #e2e8f0; position: relative; overflow: hidden; margin-top: 4rem;}
        .footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #10b981, #34d399, #10b981); }
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
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .page-hero-img, .page-hero-img-left { display: none; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="nav-container">
            <a href="{{ route('index') }}" class="logo"><i class="fas fa-leaf"></i> <span>Smart</span>Cal</a>
            <div class="nav-links">
                <a href="{{ route('platform.features') }}">Features</a>
                <a href="{{ route('how.it.works') }}">How it Works</a>
                <a href="{{ route('success.stories') }}">Success Stories</a>
                <a href="{{ route('login') }}" class="nav-btn">LOGIN</a>
            </div>
        </div>
    </nav>
    <div class="page-hero">
        <div class="reveal">
            <h1>Dietary Guidelines</h1>
            <p>Science-backed principles to help you maintain a balanced, healthy, and sustainable lifestyle.</p>
        </div>
    </div>
    <div class="content-wrap">
                    <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=600" class="page-hero-img" alt="Dietary Guidelines" onerror="this.src='https://via.placeholder.com/600x400/10b981/ffffff?text=Dietary+Guidelines'">
            <div class="card-grid">
                <div class="info-card reveal">
                    <i class="fas fa-apple-alt"></i>
                    <h3>Focus on Whole Foods</h3>
                    <p>Prioritize foods in their natural state. Fruits, vegetables, lean proteins, and whole grains should make up the majority of your caloric intake for optimal micronutrient density.</p>
                </div>
                <div class="info-card reveal">
                    <i class="fas fa-tint"></i>
                    <h3>Stay Hydrated</h3>
                    <p>Water is essential for metabolic functions. Aim for at least 2-3 liters of water per day, and more if you are physically active or living in a hot climate.</p>
                </div>
                <div class="info-card reveal">
                    <i class="fas fa-balance-scale"></i>
                    <h3>Understand Your Macros</h3>
                    <p>Not all calories are created equal. Balance your proteins for muscle repair, fats for hormone health, and carbohydrates for immediate and sustained energy.</p>
                </div>
                <div class="info-card reveal">
                    <i class="fas fa-clock"></i>
                    <h3>Mindful Eating</h3>
                    <p>Take time to chew your food and listen to your body's satiety signals. Eating slowly can significantly reduce overeating and improve digestion.</p>
                </div>
            </div>
            <div class="text-content reveal" style="margin-top: 3rem;">
                <h3>Building a Sustainable Diet</h3>
                <p>Fad diets often promise quick results, but they rarely last. The core philosophy at SmartCal is sustainability. We encourage our users to adopt dietary habits that they can maintain for years, not just weeks.</p>
                <p>Here are a few principles to keep in mind:</p>
                <ul>
                    <li><strong>The 80/20 Rule:</strong> Aim to get 80% of your calories from whole, unprocessed foods. Leave the remaining 20% for treats and foods you love. This prevents diet fatigue.</li>
                    <li><strong>Protein is Key:</strong> Protein is highly satiating and crucial for muscle preservation, especially if you are eating in a caloric deficit.</li>
                    <li><strong>Don't Fear Fats:</strong> Healthy fats (like those found in avocados, nuts, and olive oil) are vital for hormone production and nutrient absorption.</li>
                </ul>
                <p>Remember, consistency over time is what yields results. Use SmartCal as a tool to guide your choices, but always listen to your body and consult with a healthcare professional before making drastic dietary changes.</p>
            </div>
        </div>
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
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.top-nav');
            if (window.scrollY > 50) { nav.classList.add('scrolled'); } else { nav.classList.remove('scrolled'); }
        });
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) { reveals[i].classList.add("active"); }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal();
    </script>
</body>
</html>
