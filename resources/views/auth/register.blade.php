<x-guest-layout>
    <div class="p-2">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-2">Daftarkan akun admin untuk mengelola CMS.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-semibold" />
                <x-text-input id="name" class="block mt-2 w-full py-2.5 px-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Contoh: Budi Santoso" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" value="Username" class="text-gray-700 font-semibold" />
                <x-text-input id="username" class="block mt-2 w-full py-2.5 px-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" type="text" name="username" :value="old('username')" required autocomplete="username" placeholder="Contoh: budi123" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div x-data="{ show: false }">
                <x-input-label for="password" value="Password" class="text-gray-700 font-semibold" />
                <div class="mt-2 relative rounded-md shadow-sm">
                    <input id="password" :type="show ? 'text' : 'password'" name="password" class="block w-full pr-10 py-2.5 px-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-sekolah-green focus:outline-none transition-colors">
                        <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        <svg x-show="show" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div x-data="{ showConf: false }">
                <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-semibold" />
                <div class="mt-2 relative rounded-md shadow-sm">
                    <input id="password_confirmation" :type="showConf ? 'text' : 'password'" name="password_confirmation" class="block w-full pr-10 py-2.5 px-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green focus:bg-white rounded-lg transition-all" required autocomplete="new-password" placeholder="Ulangi password Anda" />
                    
                    <button type="button" @click="showConf = !showConf" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-sekolah-green focus:outline-none transition-colors">
                        <svg x-show="!showConf" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        <svg x-show="showConf" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-sekolah-green hover:bg-sekolah-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sekolah-green transition-all duration-200 transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </div>

            <div class="mt-4 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-600">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-bold text-sekolah-green hover:text-sekolah-green-dark hover:underline transition-colors">
                        Login di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>