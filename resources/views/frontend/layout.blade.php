<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profile->name ?? 'Profil Sekolah' }}</title>
    <meta name="description" content="{{ $profile->slogan ?? 'Website resmi sekolah kami' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body { background: #f0fdf4; color: #14532d; }

        /* ── Gradients ── */
        .gradient-hero { background: linear-gradient(135deg, #052e16 0%, #14532d 40%, #166534 70%, #15803d 100%); }
        .gradient-section-alt { background: linear-gradient(180deg, #f0fdf4 0%, #dcfce7 100%); }
        .gradient-accent {
            background: linear-gradient(135deg, #16a34a, #22c55e, #4ade80);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #fff; transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(22,163,74,0.35);
        }
        .btn-primary:hover { background: linear-gradient(135deg, #15803d, #16a34a); box-shadow: 0 6px 28px rgba(22,163,74,0.5); transform: translateY(-2px); }
        .btn-outline {
            border: 2px solid rgba(255,255,255,0.4); color: #fff;
            background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); transition: all 0.3s ease;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.7); transform: translateY(-2px); }

        /* ── Cards ── */
        .card {
            background: #fff; border: 1px solid #bbf7d0; border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(22,163,74,0.07);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .card:hover { box-shadow: 0 8px 36px rgba(22,163,74,0.16); transform: translateY(-3px); }

        /* ── Navbar ── */
        .nav-sticky {
            background: rgba(5, 46, 22, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(74,222,128,0.15);
            transition: box-shadow 0.3s ease;
        }
        .nav-sticky.scrolled { box-shadow: 0 4px 32px rgba(5,46,22,0.5); }
        .nav-link {
            position: relative; padding-bottom: 3px;
            color: #bbf7d0; transition: color 0.2s;
        }
        .nav-link::after {
            content: ''; position: absolute;
            bottom: 0; left: 50%; transform: translateX(-50%);
            width: 0; height: 2px; background: #4ade80;
            border-radius: 9999px; transition: width 0.3s ease;
        }
        .nav-link:hover, .nav-link.active { color: #4ade80; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* ── Mobile menu ── */
        .mobile-menu { transition: max-height 0.4s ease, opacity 0.3s ease; max-height: 0; opacity: 0; overflow: hidden; }
        .mobile-menu.open { max-height: 400px; opacity: 1; }

        /* ── Section labels ── */
        .section-tag {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.7rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;
            color: #16a34a; background: #dcfce7; border: 1px solid #86efac;
            border-radius: 9999px; padding: 4px 14px; margin-bottom: 10px;
        }
        .divider-green {
            width: 48px; height: 4px;
            background: linear-gradient(90deg, #16a34a, #4ade80);
            border-radius: 9999px; margin: 10px 0 20px 0;
        }

        /* ── Scroll progress bar ── */
        #scroll-progress {
            position: fixed; top: 0; left: 0; z-index: 9999;
            height: 3px; width: 0%;
            background: linear-gradient(90deg, #16a34a, #4ade80, #22d3ee);
            transition: width 0.1s linear;
            border-radius: 0 2px 2px 0;
        }

        /* ── Scroll reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.65s cubic-bezier(.4,0,.2,1), transform 0.65s cubic-bezier(.4,0,.2,1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left  { opacity: 0; transform: translateX(-40px); transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal-left.visible  { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px);  transition: opacity 0.65s ease, transform 0.65s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* Stagger delays */
        .delay-100 { transition-delay: 0.10s !important; }
        .delay-200 { transition-delay: 0.20s !important; }
        .delay-300 { transition-delay: 0.30s !important; }
        .delay-400 { transition-delay: 0.40s !important; }
        .delay-500 { transition-delay: 0.50s !important; }

        /* ── Floating dots canvas ── */
        #dots-canvas { position: absolute; inset: 0; pointer-events: none; }

        /* ── Back-to-top button ── */
        #back-to-top {
            position: fixed; bottom: 28px; right: 24px; z-index: 999;
            width: 44px; height: 44px; border-radius: 50%;
            background: linear-gradient(135deg, #16a34a, #4ade80);
            color: #fff; font-size: 1.1rem; font-weight: bold;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(22,163,74,0.45);
            opacity: 0; transform: translateY(16px) scale(0.85);
            transition: opacity 0.3s ease, transform 0.3s ease;
            cursor: pointer; border: none;
        }
        #back-to-top.show { opacity: 1; transform: translateY(0) scale(1); }
        #back-to-top:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 8px 28px rgba(22,163,74,0.55); }

        /* ── Decorative SVG leaf ── */
        .leaf-ornament { pointer-events: none; user-select: none; }

        /* ── Tilt card ── */
        .tilt-card { transition: transform 0.15s ease, box-shadow 0.15s ease; will-change: transform; }
    </style>
</head>
<body class="antialiased">

    <!-- Scroll progress bar -->
    <div id="scroll-progress"></div>

    <!-- Back to top -->
    <button id="back-to-top" aria-label="Kembali ke atas">↑</button>

    <!-- Navbar -->
    <nav class="nav-sticky sticky top-0 z-50" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    @if(isset($profile) && $profile->logo)
                        <img src="{{ asset($profile->logo) }}" alt="Logo" class="h-10 w-10 rounded-full object-cover ring-2 ring-green-400/40">
                    @endif
                    <span class="font-black text-lg md:text-xl text-green-300 tracking-tight">{{ $profile->name ?? 'Sekolah Kita' }}</span>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8 font-semibold text-sm">
                    <a href="#beranda" class="nav-link" data-section="beranda">Beranda</a>
                    <a href="#profil"  class="nav-link" data-section="profil">Profil</a>
                    <a href="#berita"  class="nav-link" data-section="berita">Berita</a>
                    <a href="#galeri"  class="nav-link" data-section="galeri">Galeri</a>
                    <a href="#kontak"  class="nav-link" data-section="kontak">Kontak</a>
                </div>

                <!-- Hamburger -->
                <button id="hamburger" class="md:hidden w-9 h-9 flex flex-col justify-center items-center gap-1.5 focus:outline-none" aria-label="Menu">
                    <span class="block w-6 h-0.5 bg-green-300 rounded transition-all duration-300" id="hb1"></span>
                    <span class="block w-6 h-0.5 bg-green-300 rounded transition-all duration-300" id="hb2"></span>
                    <span class="block w-4 h-0.5 bg-green-300 rounded transition-all duration-300 self-end" id="hb3"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu md:hidden">
                <div class="py-4 flex flex-col gap-4 text-sm font-semibold border-t border-green-900">
                    <a href="#beranda" class="mobile-nav-link text-green-200 hover:text-green-400 transition-colors">Beranda</a>
                    <a href="#profil"  class="mobile-nav-link text-green-200 hover:text-green-400 transition-colors">Profil</a>
                    <a href="#berita"  class="mobile-nav-link text-green-200 hover:text-green-400 transition-colors">Berita</a>
                    <a href="#galeri"  class="mobile-nav-link text-green-200 hover:text-green-400 transition-colors">Galeri</a>
                    <a href="#kontak"  class="mobile-nav-link text-green-200 hover:text-green-400 transition-colors">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-hero text-white pt-16 pb-8 relative overflow-hidden">
        <!-- Subtle leaf ornament in footer -->
        <svg class="leaf-ornament absolute -top-10 right-10 opacity-5 w-64 h-64" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 10 C60 10, 10 60, 10 100 C10 140, 60 190, 100 190 C140 190, 190 140, 190 100 C190 60, 140 10, 100 10Z" fill="#4ade80"/>
            <path d="M100 30 C70 50, 50 80, 100 170 C150 80, 130 50, 100 30Z" fill="#22c55e" opacity="0.6"/>
        </svg>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
                <div class="reveal">
                    <h3 class="text-xl font-black text-green-300 mb-4">{{ $profile->name ?? 'Sekolah Kita' }}</h3>
                    <p class="text-green-200/70 text-sm leading-relaxed mb-4">{{ $profile->slogan ?? '' }}</p>
                    <p class="text-green-300/60 text-xs">
                        <span class="text-green-400 font-bold">NPSN:</span> {{ $profile->npsn ?? '-' }} &nbsp;|&nbsp;
                        <span class="text-green-400 font-bold">Akreditasi:</span> {{ $profile->accreditation ?? '-' }}
                    </p>
                </div>
                <div class="reveal delay-100">
                    <h3 class="text-base font-bold text-white mb-5 flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-green-400 rounded inline-block"></span>
                        Kontak Kami
                    </h3>
                    <ul class="text-sm text-green-200/70 space-y-3">
                        <li class="flex items-start gap-3"><span class="text-green-400 mt-0.5">📍</span>{{ $profile->address ?? '-' }}</li>
                        <li class="flex items-center gap-3"><span class="text-green-400">📞</span>{{ $profile->whatsapp ?? ($profile->phone ?? '-') }}</li>
                        <li class="flex items-center gap-3"><span class="text-green-400">✉️</span>{{ $profile->email ?? '-' }}</li>
                    </ul>
                </div>
                <div class="reveal delay-200">
                    <h3 class="text-base font-bold text-white mb-5 flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-green-400 rounded inline-block"></span>
                        Media Sosial
                    </h3>
                    <div class="flex flex-col gap-3 text-sm">
                        @if(isset($profile->instagram)) <a href="{{ $profile->instagram }}" target="_blank" class="text-green-200/70 hover:text-green-300 transition-colors flex items-center gap-2"><span>📸</span> Instagram</a> @endif
                        @if(isset($profile->facebook))  <a href="{{ $profile->facebook }}"  target="_blank" class="text-green-200/70 hover:text-green-300 transition-colors flex items-center gap-2"><span>📘</span> Facebook</a>  @endif
                        @if(isset($profile->youtube))   <a href="{{ $profile->youtube }}"   target="_blank" class="text-green-200/70 hover:text-green-300 transition-colors flex items-center gap-2"><span>▶️</span> YouTube</a>   @endif
                        @if(isset($profile->tiktok))    <a href="{{ $profile->tiktok }}"    target="_blank" class="text-green-200/70 hover:text-green-300 transition-colors flex items-center gap-2"><span>🎵</span> TikTok</a>    @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-green-800/50 pt-8 text-center text-xs text-green-400/50">
                &copy; {{ date('Y') }} {{ $profile->name ?? 'Sekolah Kita' }}. All rights reserved. Crafted with ❤️
            </div>
        </div>
    </footer>

    <script>
    // ── 1. Hamburger toggle ──────────────────────────────────
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const hb1 = document.getElementById('hb1');
    const hb3 = document.getElementById('hb3');
    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        hb1.classList.toggle('rotate-45');
        hb1.classList.toggle('translate-y-2');
        hb3.classList.toggle('opacity-0');
    });
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            hb1.classList.remove('rotate-45','translate-y-2');
            hb3.classList.remove('opacity-0');
        });
    });

    // ── 2. Scroll progress bar ───────────────────────────────
    const progressBar = document.getElementById('scroll-progress');
    function updateProgress() {
        const scrolled = window.scrollY;
        const total    = document.documentElement.scrollHeight - window.innerHeight;
        progressBar.style.width = (total > 0 ? (scrolled / total) * 100 : 0) + '%';
    }

    // ── 3. Back-to-top ───────────────────────────────────────
    const btt = document.getElementById('back-to-top');
    btt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // ── 4. Navbar shadow + active section highlight ──────────
    const navbar    = document.getElementById('navbar');
    const navLinks  = document.querySelectorAll('.nav-link[data-section]');
    const sections  = ['beranda','profil','berita','galeri','kontak'];

    function onScroll() {
        updateProgress();

        // Back-to-top visibility
        if (window.scrollY > 400) btt.classList.add('show');
        else                       btt.classList.remove('show');

        // Navbar scrolled shadow
        if (window.scrollY > 10) navbar.classList.add('scrolled');
        else                      navbar.classList.remove('scrolled');

        // Active section
        let current = '';
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 100) current = id;
        });
        navLinks.forEach(link => {
            link.classList.toggle('active', link.dataset.section === current);
        });
    }
    window.addEventListener('scroll', onScroll, { passive: true });

    // ── 5. Scroll reveal (IntersectionObserver) ───────────────
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                revealObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => revealObs.observe(el));

    // ── 6. Subtle tilt on tilt-card elements ─────────────────
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect  = card.getBoundingClientRect();
            const x     = (e.clientX - rect.left) / rect.width  - 0.5;
            const y     = (e.clientY - rect.top)  / rect.height - 0.5;
            card.style.transform = `perspective(600px) rotateX(${-y * 6}deg) rotateY(${x * 6}deg) scale(1.02)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    // ── 7. Floating dots canvas (hero only) ──────────────────
    function initDots(canvasId) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        const ctx   = canvas.getContext('2d');
        let W = canvas.offsetWidth, H = canvas.offsetHeight;
        canvas.width = W; canvas.height = H;

        const DOT_COUNT = Math.min(40, Math.floor(W * H / 18000));
        const dots = Array.from({ length: DOT_COUNT }, () => ({
            x: Math.random() * W, y: Math.random() * H,
            r: Math.random() * 2 + 1,
            vx: (Math.random() - 0.5) * 0.3,
            vy: (Math.random() - 0.5) * 0.3,
            a: Math.random() * 0.4 + 0.1,
        }));

        function draw() {
            ctx.clearRect(0, 0, W, H);
            dots.forEach(d => {
                d.x += d.vx; d.y += d.vy;
                if (d.x < 0) d.x = W;
                if (d.x > W) d.x = 0;
                if (d.y < 0) d.y = H;
                if (d.y > H) d.y = 0;
                ctx.beginPath();
                ctx.arc(d.x, d.y, d.r, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(74,222,128,${d.a})`;
                ctx.fill();
            });
            // Draw connecting lines for nearby dots
            for (let i = 0; i < dots.length; i++) {
                for (let j = i + 1; j < dots.length; j++) {
                    const dx   = dots[i].x - dots[j].x;
                    const dy   = dots[i].y - dots[j].y;
                    const dist = Math.sqrt(dx*dx + dy*dy);
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.moveTo(dots[i].x, dots[i].y);
                        ctx.lineTo(dots[j].x, dots[j].y);
                        ctx.strokeStyle = `rgba(74,222,128,${0.12 * (1 - dist/120)})`;
                        ctx.lineWidth   = 1;
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(draw);
        }
        draw();

        window.addEventListener('resize', () => {
            W = canvas.offsetWidth; H = canvas.offsetHeight;
            canvas.width = W; canvas.height = H;
        });
    }
    initDots('dots-canvas');
    </script>
</body>
</html>