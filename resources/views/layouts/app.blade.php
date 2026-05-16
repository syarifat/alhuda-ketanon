<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }} — CMS</title>
    @php
        $appProfile = \App\Models\SchoolProfile::first();
        $headLogoUrl = ($appProfile && $appProfile->logo && \Illuminate\Support\Str::contains($appProfile->logo, ['/'])) ? Storage::url($appProfile->logo) : asset($appProfile->logo ?? 'logo.png');
    @endphp
    <link rel="icon" href="{{ $headLogoUrl }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        :root {
            --sidebar-w: 260px;
            --topbar-h: 60px;
            --green-dark: #052e16;
            --green-mid:  #14532d;
            --green-main: #16a34a;
            --green-light:#4ade80;
        }

        body { background: #f1f5f2; }

        /* ── Sidebar ── */
        #admin-sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: linear-gradient(175deg, #052e16 0%, #14532d 60%, #166534 100%);
            z-index: 200;
            display: flex; flex-direction: column;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            box-shadow: 4px 0 24px rgba(5,46,22,0.18);
        }
        #admin-sidebar.closed { transform: translateX(calc(-1 * var(--sidebar-w))); }

        /* ── Sidebar brand ── */
        .sidebar-brand {
            padding: 20px 22px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .sidebar-brand-text { font-size: 0.9rem; font-weight: 800; color: #f0fdf4; line-height: 1.2; }
        .sidebar-brand-sub  { font-size: 0.65rem; color: #86efac; font-weight: 500; letter-spacing: 0.06em; text-transform: uppercase; }

        /* ── Nav items ── */
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 12px 12px; }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 9999px; }

        .nav-group-label {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: rgba(134,239,172,0.5);
            padding: 12px 10px 6px; margin-top: 4px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px; border-radius: 10px; margin-bottom: 2px;
            color: #bbf7d0; font-size: 0.85rem; font-weight: 600;
            text-decoration: none; position: relative;
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; transform: translateX(2px); }
        .nav-item.active {
            background: linear-gradient(90deg, rgba(74,222,128,0.18), rgba(74,222,128,0.06));
            color: #4ade80;
            border-left: 3px solid #4ade80;
            padding-left: 9px;
        }
        .nav-item.active::before {
            content: '';
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            width: 6px; height: 6px; border-radius: 50%;
            background: #4ade80; box-shadow: 0 0 6px #4ade80;
        }
        .nav-icon {
            width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 1rem;
            background: rgba(255,255,255,0.05);
            transition: background 0.2s;
        }
        .nav-item.active .nav-icon { background: rgba(74,222,128,0.2); }
        .nav-item:hover .nav-icon  { background: rgba(255,255,255,0.12); }

        /* ── Sidebar footer ── */
        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: rgba(255,255,255,0.06);
        }
        .sidebar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 800; color: #052e16; flex-shrink: 0;
        }
        .sidebar-user-name  { font-size: 0.8rem; font-weight: 700; color: #f0fdf4; line-height: 1.2; }
        .sidebar-user-email { font-size: 0.65rem; color: #86efac; }

        /* ── Overlay (mobile) ── */
        #sidebar-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 199;
            background: rgba(5,46,22,0.55);
            backdrop-filter: blur(2px);
        }
        #sidebar-overlay.visible { display: block; }

        /* ── Main area ── */
        #admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(.4,0,.2,1);
            display: flex; flex-direction: column;
        }

        /* ── Topbar ── */
        #admin-topbar {
            position: sticky; top: 0; z-index: 100;
            height: var(--topbar-h);
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid #dcfce7;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 24px;
            box-shadow: 0 1px 12px rgba(5,46,22,0.06);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .topbar-title { font-size: 0.95rem; font-weight: 700; color: #14532d; }

        /* Mobile toggle button (pretty pill) */
        #sidebar-toggle {
            display: none;
            align-items: center; gap: 6px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #fff; font-size: 0.75rem; font-weight: 700;
            padding: 7px 14px; border-radius: 9999px; border: none; cursor: pointer;
            box-shadow: 0 2px 10px rgba(22,163,74,0.4);
            transition: box-shadow 0.2s, transform 0.15s;
        }
        #sidebar-toggle:hover { box-shadow: 0 4px 16px rgba(22,163,74,0.55); transform: scale(1.04); }

        /* ── Page content ── */
        #admin-content { flex: 1; padding: 28px 24px; }

        /* ── Page header card ── */
        .page-header {
            background: #fff;
            border: 1px solid #dcfce7;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px;
            box-shadow: 0 2px 12px rgba(5,46,22,0.05);
        }
        .page-header h2 { font-size: 1.2rem; font-weight: 800; color: #14532d; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            #admin-sidebar { transform: translateX(calc(-1 * var(--sidebar-w))); }
            #admin-sidebar.open { transform: translateX(0); }
            #admin-main { margin-left: 0; }
            #sidebar-toggle { display: flex; }
            #admin-content { padding: 16px; }
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Sidebar overlay (mobile) -->
    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- ── SIDEBAR ── -->
    <aside id="admin-sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon overflow-hidden p-0">
                @php
                    $appProfile = \App\Models\SchoolProfile::first();
                    $logoUrl = ($appProfile && $appProfile->logo && Str::contains($appProfile->logo, ['/'])) ? Storage::url($appProfile->logo) : asset($appProfile->logo ?? 'logo.png');
                @endphp
                <img src="{{ $logoUrl }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="sidebar-brand-text">{{ config('app.name') }}</div>
                <div class="sidebar-brand-sub">CMS Panel</div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="sidebar-nav">
            <div class="nav-group-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                Dashboard
            </a>

            <div class="nav-group-label">Konten</div>

            <a href="{{ route('admin.articles.index') }}"
               class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <span class="nav-icon">📰</span>
                Manajemen Berita
            </a>

            <a href="{{ route('admin.galleries.index') }}"
               class="nav-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <span class="nav-icon">🖼️</span>
                Galeri Kegiatan
            </a>

            <div class="nav-group-label">Administrasi</div>

            <a href="{{ route('admin.messages.index') }}"
               class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <span class="nav-icon">✉️</span>
                Pesan Masuk
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="nav-icon">👥</span>
                Kelola Users
            </a>

            <a href="{{ route('admin.school-profile.edit') }}"
               class="nav-item {{ request()->routeIs('admin.school-profile.*') ? 'active' : '' }}">
                <span class="nav-icon">🏛️</span>
                Profil Sekolah
            </a>

            <div class="nav-group-label">Akun</div>

            <a href="{{ route('profile.edit') }}"
               class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="nav-icon">⚙️</span>
                Pengaturan Profil
            </a>

            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="#" onclick="document.getElementById('logout-form').submit()" class="nav-item">
                    <span class="nav-icon">🚪</span>
                    Keluar
                </a>
            </form>
        </nav>

        <!-- User info -->
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="min-w-0">
                    <div class="sidebar-user-name truncate">{{ Auth::user()->name }}</div>
                    <div class="sidebar-user-email truncate">@ {{ Auth::user()->username }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- ── MAIN ── -->
    <div id="admin-main">

        <!-- Topbar -->
        <div id="admin-topbar">
            <div class="topbar-left">
                <!-- Mobile toggle -->
                <button id="sidebar-toggle" onclick="openSidebar()" aria-label="Buka Menu">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                        <rect y="2"  width="16" height="2" rx="1" fill="currentColor"/>
                        <rect y="7"  width="12" height="2" rx="1" fill="currentColor"/>
                        <rect y="12" width="16" height="2" rx="1" fill="currentColor"/>
                    </svg>
                    Menu
                </button>
                <!-- Breadcrumb hint -->
                <span class="topbar-title hidden sm:block">
                    {{ config('app.name') }} — Admin
                </span>
            </div>

            <!-- Right: user chip + logout -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank"
                   class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold text-green-700 hover:text-green-900 border border-green-200 hover:border-green-400 px-3 py-1.5 rounded-full transition-all bg-green-50 hover:bg-green-100">
                    🌐 Lihat Website
                </a>
                <div class="flex items-center gap-2 bg-green-50 border border-green-100 px-3 py-1.5 rounded-full">
                    <span class="w-6 h-6 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white text-xs font-black">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <span class="text-xs font-semibold text-green-900 hidden sm:block">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="admin-content">
            @isset($header)
                <div class="page-header">
                    {{ $header }}
                </div>
            @endisset

            {{ $slot }}
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('admin-sidebar').classList.add('open');
            document.getElementById('sidebar-overlay').classList.add('visible');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            document.getElementById('admin-sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('visible');
            document.body.style.overflow = '';
        }
        // Close sidebar on Escape
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeSidebar();
        });
    </script>
</body>
</html>
