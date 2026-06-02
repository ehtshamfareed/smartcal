<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCal Blog | Eat smart. Live better.</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Shared Styles */
        body { background: #f8fafc; color: #1e293b; overflow-x: hidden; font-family: 'Outfit', sans-serif; scroll-behavior: smooth; }
        
        /* Navbar */
        .top-nav {
            position: fixed; width: 100%; top: 0; z-index: 1000;
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px);
            padding: 0.8rem 0; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border-bottom: 1px solid rgba(0,0,0,0.05); transition: all 0.4s ease;
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

        /* Blog Hero */
        .blog-hero { padding: 140px 2rem 60px; background: #fff; text-align: center; border-bottom: 1px solid #e2e8f0; }
        .blog-hero h1 { font-size: 3.5rem; font-family: 'Outfit'; font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -1px;}
        .blog-hero p { font-size: 1.25rem; color: #64748b; max-width: 600px; margin: 0 auto; line-height: 1.6;}
        
        /* Blog Layout */
        .blog-container { max-width: 1200px; margin: 4rem auto; padding: 0 2rem; }
        
        /* Featured Post */
        .featured-post { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; background: #fff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.04); margin-bottom: 4rem; transition: 0.3s; cursor: pointer; border: 1px solid rgba(0,0,0,0.05); }
        .featured-post:hover { transform: translateY(-5px); box-shadow: 0 30px 60px rgba(0,0,0,0.08); }
        .featured-img { background: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=800') center/cover; min-height: 400px; }
        .featured-content { padding: 4rem 3rem 4rem 0; display: flex; flex-direction: column; justify-content: center; }
        .category-badge { display: inline-block; padding: 6px 16px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-weight: 700; font-size: 0.85rem; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem; align-self: flex-start; }
        .featured-content h2 { font-size: 2.5rem; color: #0f172a; margin-bottom: 1.5rem; font-family: 'Outfit'; font-weight: 800; line-height: 1.2; }
        .featured-content p { color: #475569; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem; }
        .read-more { font-weight: 700; color: #10b981; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; }
        .read-more:hover { gap: 0.8rem; }

        /* Grid Posts */
        .post-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2.5rem; }
        .post-card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; cursor: pointer; display: flex; flex-direction: column; }
        .post-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.06); }
        .post-img { height: 220px; background-size: cover; background-position: center; border-bottom: 1px solid rgba(0,0,0,0.05); }
        .post-content { padding: 2rem; flex: 1; display: flex; flex-direction: column; }
        .post-content h3 { font-size: 1.4rem; color: #0f172a; margin: 1rem 0; font-family: 'Outfit'; font-weight: 800; line-height: 1.3; }
        .post-content p { color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1; }

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

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .featured-post { grid-template-columns: 1fr; }
            .featured-img { min-height: 250px; }
            .featured-content { padding: 2rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
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
                <a href="{{ route('blogs') }}" style="color: #10b981;">Blog</a>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-btn">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="nav-btn">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Blog Hero -->
    <header class="blog-hero">
        <div class="reveal active">
            <h1>SmartCal Blog</h1>
            <p>Eat smart. Live better. Explore our latest articles on nutrition, fitness, and building sustainable health habits.</p>
        </div>
    </header>

    <!-- Blog Content -->
    <main class="blog-container">
        
        <!-- Featured Post -->
        <article class="featured-post reveal">
            <div class="featured-img" style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=800');"></div>
            <div class="featured-content">
                <span class="category-badge">Nutrition</span>
                <h2>The Ultimate Guide to Macro Tracking for Beginners</h2>
                <p>Starting your health journey can be overwhelming. We break down exactly how to track your proteins, fats, and carbohydrates to hit your goals without sacrificing the foods you love.</p>
                <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
            </div>
        </article>

        <!-- Post Grid -->
        <div class="post-grid">
            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1498837167922-41c53b4f094b?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge" style="background: rgba(56, 189, 248, 0.1); color: #0284c7;">Wellness</span>
                    <h3>Why Hydration is the Missing Link in Your Diet</h3>
                    <p>You're tracking your food, but are you tracking your water? Discover how hydration impacts your metabolism and energy levels.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>

            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge" style="background: rgba(245, 158, 11, 0.1); color: #d97706;">Fitness</span>
                    <h3>Fueling Your Workouts: Pre and Post Nutrition</h3>
                    <p>What you eat around your workouts matters just as much as the workout itself. Here's a guide to optimizing your gym sessions.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>

            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge">Nutrition</span>
                    <h3>5 High-Protein Breakfast Ideas for Busy Mornings</h3>
                    <p>Struggling to hit your protein goals early in the day? Try these 5 quick and delicious macro-friendly breakfast recipes.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>

            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge" style="background: rgba(139, 92, 246, 0.1); color: #7c3aed;">App Updates</span>
                    <h3>New Feature: Weekly Smoothing Charts</h3>
                    <p>We've launched a new way to view your progress. Learn how our 7-day rolling averages can cure your scale anxiety.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>
            
            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge" style="background: rgba(56, 189, 248, 0.1); color: #0284c7;">Wellness</span>
                    <h3>The 80/20 Rule: Building Sustainable Habits</h3>
                    <p>Perfection is the enemy of progress. Why allowing yourself treats 20% of the time actually leads to better long-term results.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>
            
            <article class="post-card reveal">
                <div class="post-img" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&q=80&w=600');"></div>
                <div class="post-content">
                    <span class="category-badge">Nutrition</span>
                    <h3>Understanding Micronutrients</h3>
                    <p>Macros get all the glory, but micros run the machine. A deep dive into vitamins and minerals you should be tracking.</p>
                    <div class="read-more">Read Article <i class="fas fa-arrow-right"></i></div>
                </div>
            </article>
        </div>
    </main>

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
        // Scroll Reveal Animation
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
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
