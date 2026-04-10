<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CMS Web Sekolah') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-gray-50">
            
            @include('layouts.navigation')

            <div class="flex flex-col flex-1 w-full overflow-hidden">
                
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm z-10">
                    <div class="flex items-center">
                        
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden hover:text-sekolah-green transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        @isset($header)
                            <div class="hidden lg:block lg:ml-4 text-xl font-semibold text-gray-800">
                                {{ $header }}
                            </div>
                        @endisset
                    </div>

                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-sekolah-green focus:outline-none transition ease-in-out duration-150">
                                    <div class="hidden sm:block mr-2 text-right">
                                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-sekolah-green uppercase">{{ Auth::user()->role }}</p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-sekolah-green text-white flex items-center justify-center font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile Saya') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                        {{ __('Keluar (Log Out)') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                    @isset($header)
                        <div class="block lg:hidden mb-6 text-xl font-semibold text-gray-800 border-b pb-2">
                            {{ $header }}
                        </div>
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>
        
    </body>
</html>