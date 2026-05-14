<nav class="bg-white shadow-sm border-b border-gray-100 w-full z-50 fixed top-0 h-20" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-3 text-2xl font-black tracking-tight text-orange-600 group">
                    <img src="{{ asset('images/kedai.uqy.jpeg') }}" alt="Kedai Uqy Logo" class="w-12 h-12 rounded-full object-cover transform group-hover:-rotate-6 transition-transform duration-300 shadow-md border-2 border-orange-100">
                    <span>Kedai<span class="text-gray-900">Uqy</span></span>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="font-semibold {{ request()->routeIs('welcome') ? 'text-orange-600' : 'text-gray-600 hover:text-orange-500' }} transition-colors">Home</a>
                <a href="{{ route('menu') }}" class="font-semibold {{ request()->routeIs('menu') ? 'text-orange-600' : 'text-gray-600 hover:text-orange-500' }} transition-colors">Menu</a>
                
                @guest
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-orange-500 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full font-bold text-white bg-orange-600 hover:bg-orange-700 transition-all shadow-md hover:shadow-orange-500/30 hover:-translate-y-0.5">Register</a>
                @endguest

                @auth
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center space-x-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="dropdownOpen" style="display: none;" x-transition.opacity.duration.200ms class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">Admin Panel</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">Profil Saya</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="focus:outline-none text-gray-900 p-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" style="display: none;" x-transition.opacity class="md:hidden bg-white shadow-xl absolute w-full border-t border-gray-100 left-0 top-20">
        <div class="px-4 py-6 space-y-2">
            <a href="/" class="block px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('welcome') ? 'text-orange-600 bg-orange-50' : 'text-gray-900 hover:bg-orange-50 hover:text-orange-600' }} transition-colors">Home</a>
            <a href="{{ route('menu') }}" class="block px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('menu') ? 'text-orange-600 bg-orange-50' : 'text-gray-900 hover:bg-orange-50 hover:text-orange-600' }} transition-colors">Menu</a>
            @guest
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-900 hover:bg-orange-50 hover:text-orange-600 transition-colors">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-white bg-orange-600 hover:bg-orange-700 text-center mt-4 transition-all shadow-md">Register</a>
            @endguest
            @auth
                <div class="border-t border-gray-100 mt-4 pt-4">
                    <div class="px-4 text-sm font-medium text-gray-500 mb-2">Logged in as <span class="text-orange-600">{{ Auth::user()->name }}</span></div>
                    
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-900 hover:bg-orange-50 hover:text-orange-600 transition-colors">Admin Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-900 hover:bg-orange-50 hover:text-orange-600 transition-colors">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-900 hover:bg-orange-50 hover:text-orange-600 transition-colors">Profil Saya</a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-3 rounded-xl text-base font-bold text-red-600 hover:bg-red-50 transition-colors">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
