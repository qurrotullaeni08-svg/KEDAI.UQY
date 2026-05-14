<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kedai Uqy') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind & Alpine -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 selection:bg-orange-500 selection:text-white" x-data="{ sidebarOpen: false }">

    <!-- Top Navbar Modern -->
    @include('layouts.navigation')

    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden pt-20"> <!-- pt-20 offset for fixed navbar -->
        
        <!-- Sidebar Navigation -->
        @auth
            @if(request()->routeIs('dashboard', 'admin.*', 'profile.*', 'orders.*'))
                @include('layouts.sidebar')
            @endif
        @endauth

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 relative">
            
            <!-- Optional Page Header for Dashboard/Admin -->
            @if(isset($header))
                <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-20">
                    <div class="flex items-center gap-4">
                        @auth
                            @if(request()->routeIs('dashboard', 'admin.*', 'profile.*', 'orders.*'))
                                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            @endif
                        @endauth
                        <div class="text-xl font-bold text-gray-800">{{ $header }}</div>
                    </div>
                </header>
            @endif

            <!-- Content -->
            <main class="flex-1 w-full pb-10 px-4 sm:px-6 lg:px-8 pt-6">
                <!-- Global Alerts -->
                <div class="max-w-7xl mx-auto w-full">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-start" x-data="{ show: true }" style="display: none;" x-show="show" x-transition>
                            <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="flex-1">
                                <h3 class="text-green-800 font-bold">Berhasil!</h3>
                                <p class="text-green-700 mt-1">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm flex items-start" x-data="{ show: true }" style="display: none;" x-show="show" x-transition>
                            <svg class="w-6 h-6 text-red-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="flex-1">
                                <h3 class="text-red-800 font-bold">Gagal!</h3>
                                <p class="text-red-700 mt-1">{{ session('error') }}</p>
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    @endif
                </div>

                <div class="max-w-7xl mx-auto w-full">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @if(!request()->routeIs('dashboard', 'admin.*', 'profile.*', 'orders.*'))
                <div class="w-full px-4 sm:px-6 lg:px-8 pb-8 mt-auto">
                    <footer class="max-w-7xl mx-auto bg-[#1a1512] text-gray-300 pt-16 pb-10 w-full">
                        <div class="px-6 sm:px-10 lg:px-12">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                            <!-- Kolom 1: Logo & Deskripsi -->
                            <div class="space-y-6">
                                <div class="flex items-start gap-3">
                                    <img src="{{ asset('images/kedai.uqy.jpeg') }}" alt="Logo Kedai Uqy" class="w-12 h-12 rounded-xl object-cover shadow-lg shadow-orange-500/20 border-2 border-orange-500/20">
                                    <span class="text-2xl font-black text-white tracking-tight pt-1">Kedai <span class="text-orange-500">Uqy</span></span>
                                </div>
                                <p class="text-gray-400 leading-relaxed max-w-sm">
                                    Catering terbaik untuk kebutuhan harian dan acara Anda. Kami menyajikan hidangan lezat dengan resep rahasia yang dijamin akan memanjakan lidah Anda.
                                </p>
                                <div class="flex gap-4 pt-2">
                                    <!-- Instagram -->
                                    <a href="https://www.instagram.com/kedai.uqy?igsh=NmkwZzZxN2J3dDl0" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 hover:text-white flex items-center justify-center transition-all duration-300 text-gray-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                    <!-- WhatsApp -->
                                    <a href="https://wa.me/6289503095910" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-orange-500 hover:text-white flex items-center justify-center transition-all duration-300 text-gray-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Kolom 2: Navigasi -->
                            <div class="md:pl-10 lg:pl-16">
                                <div class="h-12 flex items-start pt-1 mb-6">
                                    <h3 class="text-white font-bold text-xl tracking-wide">Tautan Cepat</h3>
                                </div>
                                <ul class="space-y-4">
                                    <li><a href="/" class="text-gray-400 hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Beranda</a></li>
                                    <li><a href="/#menu" class="text-gray-400 hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Menu Pilihan</a></li>
                                    <li><a href="/menu" class="text-gray-400 hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Pesan Sekarang</a></li>
                                    <li><a href="/#lokasi" class="text-gray-400 hover:text-orange-500 hover:translate-x-1 inline-block transition-all duration-300">Lokasi Kami</a></li>
                                </ul>
                            </div>

                            <!-- Kolom 3: Kontak -->
                            <div>
                                <div class="h-12 flex items-start pt-1 mb-6">
                                    <h3 class="text-white font-bold text-xl tracking-wide">Hubungi Kami</h3>
                                </div>
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-orange-500 mr-3 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="text-gray-400">Jalan Pangeran Antasari, RT.10/RW.4, Kelurahan Desa Purbawinangun, Plumbon</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <a href="https://wa.me/6289503095910" class="text-gray-400 hover:text-orange-500 transition-colors">+62 895-0309-5910</a>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-orange-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                        <a href="https://www.instagram.com/kedai.uqy" target="_blank" class="text-gray-400 hover:text-orange-500 transition-colors">@kedai.uqy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Divider & Copyright -->
                        <div class="border-t border-white/10 pt-8 flex flex-col items-center justify-center gap-4 text-center">
                            <p class="text-gray-500 text-sm">
                                &copy; {{ date('Y') }} Kedai Uqy. All rights reserved.
                            </p>
                            <p class="text-gray-400 text-sm flex items-center justify-center gap-1.5">
                                Dikembangkan dengan <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> oleh <span class="font-bold text-gray-300 hover:text-orange-500 transition-colors cursor-pointer">Tim Mahasiswa STMIK IKMI Cirebon</span>
                            </p>
                            <div class="flex gap-4 text-sm text-gray-500 mt-2">
                                <a href="#" class="hover:text-orange-500 transition-colors">Kebijakan Privasi</a>
                                <span>&bull;</span>
                                <a href="#" class="hover:text-orange-500 transition-colors">Syarat & Ketentuan</a>
                            </div>
                        </div>
                    </div>
                    </footer>
                </div>
            @endif
        </div>
    </div>

    <!-- Global Login Modal -->
    <div x-data="{ loginModalOpen: false }" @open-login-modal.window="loginModalOpen = true">
        <div x-show="loginModalOpen" style="display: none;" x-transition.opacity class="fixed inset-0 bg-gray-950/80 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
            <div x-show="loginModalOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-8"
                 @click.outside="loginModalOpen = false"
                 class="bg-[#1a1512] border border-orange-900/50 rounded-3xl w-full max-w-md p-8 relative shadow-[0_20px_50px_rgba(234,88,12,0.15)] text-center">
                
                <!-- Close Button -->
                <button @click="loginModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors bg-white/5 hover:bg-orange-500 rounded-full p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <!-- Icon -->
                <div class="w-20 h-20 bg-orange-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-orange-500/20">
                    <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>

                <!-- Text -->
                <h3 class="text-2xl font-black text-white tracking-tight mb-3">Akses <span class="text-orange-500">Dibatasi</span></h3>
                <p class="text-gray-400 mb-8 leading-relaxed text-sm">Anda perlu mendaftar atau masuk ke akun terlebih dahulu untuk memesan makanan dan menggunakan keranjang.</p>

                <!-- Buttons -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}" class="w-full py-3.5 rounded-xl text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 font-bold transition-all shadow-lg hover:shadow-orange-500/40 hover:-translate-y-0.5">
                        Sudah Memiliki Akun
                    </a>
                    <a href="{{ route('register') }}" class="w-full py-3.5 rounded-xl text-orange-500 bg-white/5 border border-orange-500/30 hover:bg-orange-500/10 hover:border-orange-500 font-bold transition-all">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
