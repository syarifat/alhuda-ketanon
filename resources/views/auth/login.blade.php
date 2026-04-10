<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="p-2">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang!</h2>
            <p class="text-sm text-gray-500 mt-2">Silakan masuk ke panel CMS Web Sekolah.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="username" value="Username" class="text-gray-700 font-semibold" />
                <div class="mt-2 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="username" class="block w-full pl-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Masukkan username Anda" />
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div x-data="{ show: false }">
                <x-input-label for="password" value="Password" class="text-gray-700 font-semibold" />
                <div class="mt-2 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    
                    <input id="password" :type="show ? 'text' : 'password'" name="password" class="block w-full pl-10 pr-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" required autocomplete="current-password" placeholder="Masukkan password Anda" />
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-sekolah-green focus:outline-none transition-colors">
                        <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                        <svg x-show="show" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sekolah-green shadow-sm focus:ring-sekolah-green h-4 w-4" name="remember">
                    <span class="ms-2 text-sm text-gray-600 font-medium">Ingat Saya</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-sekolah-green hover:bg-sekolah-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sekolah-green transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Masuk (Log in)
                </button>
            </div>

            <div class="mt-6 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-600">
                    Belum memiliki akun admin?
                    <a href="{{ route('register') }}" class="font-bold text-sekolah-green hover:text-sekolah-green-dark hover:underline transition-colors">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>