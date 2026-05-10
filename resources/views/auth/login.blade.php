<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin') }} — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #052e16 0%, #14532d 50%, #15803d 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
            position: relative; overflow: hidden;
        }
        /* Decorative blobs */
        body::before {
            content: '';
            position: absolute; top: -120px; left: -120px;
            width: 500px; height: 500px; border-radius: 50%;
            background: rgba(74,222,128,0.08); filter: blur(60px);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute; bottom: -100px; right: -80px;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(34,197,94,0.06); filter: blur(60px);
            pointer-events: none;
        }
        .login-card {
            width: 100%; max-width: 420px;
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(5,46,22,0.45), 0 0 0 1px rgba(255,255,255,0.1);
            padding: 40px 36px;
            position: relative; z-index: 1;
        }
        .login-logo {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, #16a34a, #4ade80);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; margin: 0 auto 20px; box-shadow: 0 8px 24px rgba(22,163,74,0.4);
        }
        .login-title { font-size: 1.5rem; font-weight: 900; color: #14532d; text-align: center; margin-bottom: 4px; }
        .login-sub   { font-size: 0.8rem; color: #6b7280; text-align: center; margin-bottom: 28px; }
        .form-label  { display: block; font-size: 0.7rem; font-weight: 800; color: #15803d; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px; }
        .form-input  {
            display: block; width: 100%;
            border: 1.5px solid #bbf7d0; border-radius: 12px;
            padding: 11px 14px; font-size: 0.875rem; color: #14532d;
            background: #f0fdf4;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus { border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,0.15); outline: none; }
        .form-input::placeholder { color: #9ca3af; }
        .btn-login {
            width: 100%; padding: 13px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #fff; font-size: 0.9rem; font-weight: 800;
            border: none; border-radius: 12px; cursor: pointer;
            box-shadow: 0 4px 20px rgba(22,163,74,0.4);
            transition: all 0.25s;
        }
        .btn-login:hover { box-shadow: 0 6px 28px rgba(22,163,74,0.55); transform: translateY(-1px); }
        .back-link { display: block; text-align: center; margin-top: 18px; font-size: 0.78rem; color: #9ca3af; }
        .back-link a { color: #16a34a; font-weight: 700; hover: underline; }
        /* Grid pattern bg */
        .bg-grid {
            position: absolute; inset: 0; opacity: 0.03;
            background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>

    <div class="login-card">
        <div class="login-logo">
            @php
                $appProfile = \App\Models\SchoolProfile::first();
                $logoUrl = ($appProfile && $appProfile->logo && Str::contains($appProfile->logo, ['/'])) ? Storage::url($appProfile->logo) : asset($appProfile->logo ?? 'logo.png');
            @endphp
            <img src="{{ $logoUrl }}" alt="Logo Sekolah" class="w-full h-full object-contain p-1">
        </div>
        <h1 class="login-title">{{ config('app.name') }}</h1>
        <p class="login-sub">Masuk untuk mengelola konten sekolah</p>

        {{-- Session Status --}}
        @if(session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-xs font-semibold">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="form-label" for="username">Username</label>
                <input id="username" name="username" type="text"
                       value="{{ old('username') }}"
                       class="form-input" required autofocus autocomplete="username"
                       placeholder="Masukkan username">
            </div>

            <div>
                <label class="form-label" for="password">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password"
                           class="form-input pr-11" required autocomplete="current-password"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600 transition-colors" id="eye-btn">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-4 h-4 rounded border-green-300 text-green-600 focus:ring-green-500">
                <label for="remember_me" class="text-xs text-gray-500 font-semibold cursor-pointer">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Dashboard →
            </button>
        </form>

        <p class="back-link">← <a href="{{ route('home') }}">Kembali ke Website</a></p>
    </div>

    <script>
        function togglePwd() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
