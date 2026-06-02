<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | SmartCal</title>
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

    <!-- Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
            <a href="{{ route('index') }}" class="logo"><i class="fas fa-leaf"></i> <span>Smart</span>Cal</a>
            <div class="nav-links">
                <a href="{{ route('platform.features') }}">Features</a>
                <a href="{{ route('how.it.works') }}">How it Works</a>
                <a href="{{ route('success.stories') }}">Success Stories</a>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-btn">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="nav-btn">LOGIN</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="page-hero">
        <div class="reveal">
            <h1>Terms of Service</h1>
            <p>The rules and guidelines for using the SmartCal platform.</p>
        </div>
    </div>
    <div class="content-wrap">
            <div class="text-content reveal">
                <h3>1. Acceptance of Terms</h3>
                <p>By accessing and using SmartCal (the "Service"), you accept and agree to be bound by the terms and provision of this agreement. In addition, when using these particular services, you shall be subject to any posted guidelines or rules applicable to such services.</p>
                
                <h3>2. Medical Disclaimer</h3>
                <p>SmartCal provides nutritional information, caloric estimations, and fitness tracking tools for educational and informational purposes only. The Service is <strong>not</strong> intended as a substitute for professional medical advice, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical condition.</p>
                
                <h3>3. User Responsibilities & Account Security</h3>
                <p>You are responsible for maintaining the confidentiality of your account password and for all activities that occur under your account. You agree to:</p>
                <ul>
                    <li>Provide true, accurate, current, and complete information as prompted by the registration form.</li>
                    <li>Immediately notify SmartCal of any unauthorized use of your password or account.</li>
                    <li>Ensure that you exit from your account at the end of each session.</li>
                </ul>

                <h3>4. Acceptable Use and Conduct</h3>
                <p>You agree not to use the Service to:</p>
                <ul>
                    <li>Upload, post, or transmit any content that is unlawful, harmful, threatening, or otherwise objectionable.</li>
                    <li>Interfere with or disrupt the Service or servers connected to the Service.</li>
                    <li>Attempt to gain unauthorized access to any portion of the platform or any other systems or networks.</li>
                </ul>

                <h3>5. Intellectual Property</h3>
                <p>All content included on the site, such as text, graphics, logos, button icons, images, and software, is the property of SmartCal or its content suppliers and protected by international copyright laws. You may not systematically extract and/or re-utilize parts of the contents of the Service without our express written consent.</p>

                <h3>6. Limitation of Liability</h3>
                <p>In no event shall SmartCal, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>

                <h3>7. Termination</h3>
                <p>We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>

                <h3>8. Changes to Terms</h3>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms.</p>
                
                <p style="margin-top: 3rem; font-weight: bold; color: #10b981;">Last Updated: June 2026</p>
            </div>    </div>
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
