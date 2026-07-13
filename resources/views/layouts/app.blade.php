<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIAD - Sistem Absensi Digital')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="nav-brand">
                    <a href="{{ route('home') }}">
                        <h1>SIAD</h1>
                        <span>Sistem Absensi Digital</span>
                    </a>
                </div>
                <div class="nav-menu" id="navMenu">
                    <ul>
                        <li><a href="{{ route('home') }}" class="active" data-section="home">Beranda</a></li>
                        <li><a href="#features" data-section="features">Fitur</a></li>
                        <li><a href="#about" data-section="about">Tentang</a></li>
                        <li><a href="#contact" data-section="contact">Kontak</a></li>
                    </ul>
                </div>
                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });

        // ==================== NAVBAR ACTIVE STATE ====================
        // Get all nav links
        const navLinks = document.querySelectorAll('.nav-menu ul li a');
        const sections = {
            home: document.querySelector('.hero-section'),
            features: document.querySelector('#features'),
            about: document.querySelector('#about'),
            contact: document.querySelector('#contact')
        };

        // Function to update active nav link
        function updateActiveNav() {
            const scrollPosition = window.scrollY + 120; // offset for navbar
            
            // Check which section is in view
            let currentSection = 'home';
            
            if (sections.contact && scrollPosition >= sections.contact.offsetTop - 100) {
                currentSection = 'contact';
            } else if (sections.about && scrollPosition >= sections.about.offsetTop - 100) {
                currentSection = 'about';
            } else if (sections.features && scrollPosition >= sections.features.offsetTop - 100) {
                currentSection = 'features';
            } else {
                currentSection = 'home';
            }
            
            // Update active class on nav links
            navLinks.forEach(link => {
                link.classList.remove('active');
                const section = link.getAttribute('data-section');
                if (section === currentSection) {
                    link.classList.add('active');
                }
            });
        }

        // Throttle scroll event for better performance
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    updateActiveNav();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Update on load
        window.addEventListener('load', function() {
            updateActiveNav();
        });

        // ==================== SMOOTH SCROLL ====================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    const offsetTop = target.offsetTop - 80; // navbar height offset
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                    
                    // Update active state immediately
                    navLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Close mobile menu
                    navMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });
        });

        // ==================== HAMBURGER MENU ====================
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');

        hamburger.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = navMenu.contains(event.target) || hamburger.contains(event.target);
            if (!isClickInside && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                hamburger.classList.remove('active');
            }
        });

        // ==================== NAVBAR SCROLL EFFECT ====================
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ==================== BACK TO TOP ====================
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // ==================== FLOATING CARDS ====================
        document.querySelectorAll('.floating-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.5}s`;
        });
    </script>
</body>
</html>