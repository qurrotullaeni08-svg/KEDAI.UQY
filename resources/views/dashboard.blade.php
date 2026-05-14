<x-app-layout>
    <style>
        /* Custom Scrollbar for a premium feel */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Glassmorphism utilities */
        .glass-dark {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        /* Animated Gradient Background */
        .bg-animated {
            background: linear-gradient(120deg, #fffbeb, #fff7ed, #fdf4ff);
            background-size: 200% 200%;
            animation: gradientMove 15s ease infinite;
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Checkbox custom style */
        .custom-checkbox {
            appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: currentColor;
            width: 1.5em;
            height: 1.5em;
            border: 2px solid #fdba74;
            border-radius: 0.35em;
            display: grid;
            place-content: center;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        
        .custom-checkbox::before {
            content: "";
            width: 0.85em;
            height: 0.85em;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
            transform: scale(0);
            transform-origin: center;
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em white;
            background-color: white;
        }

        .custom-checkbox:checked {
            background-color: #ea580c;
            border-color: #ea580c;
        }

        .custom-checkbox:checked::before {
            transform: scale(1);
        }
        
        /* Input overrides for elegance */
        input[type="text"], input[type="email"], input[type="password"], textarea {
            border-color: #fed7aa !important;
            box-shadow: none !important;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, textarea:focus {
            border-color: #ea580c !important;
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15) !important;
        }

        /* Hide scrollbar for tabs */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="min-h-screen bg-animated py-10 relative overflow-hidden" x-data="{ tab: 'orders', selectedCarts: [] }">
        <!-- Decorative Background Elements for Content Area -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob pointer-events-none"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob animation-delay-2000 pointer-events-none"></div>
        <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob animation-delay-4000 pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- TOP NAVIGATION CARD -->
            <div class="glass-dark rounded-3xl p-3 shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-8 flex items-center justify-between">
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar w-full">
                    <!-- Nav Item: Dashboard -->
                    <button @click="tab = 'orders'" 
                            :class="tab === 'orders' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600'"
                            class="flex-1 text-center px-6 py-4 font-bold rounded-2xl transition-all duration-300 flex items-center justify-center gap-3 whitespace-nowrap">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard Utama
                    </button>

                    <!-- Nav Item: Profil -->
                    <button @click="tab = 'profile'" 
                            :class="tab === 'profile' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600'"
                            class="flex-1 text-center px-6 py-4 font-bold rounded-2xl transition-all duration-300 flex items-center justify-center gap-3 whitespace-nowrap">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </button>

                    <!-- Nav Item: Keranjang -->
                    <button @click="tab = 'cart'" 
                            :class="tab === 'cart' ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600'"
                            class="flex-1 text-center px-6 py-4 font-bold rounded-2xl transition-all duration-300 flex items-center justify-center gap-3 whitespace-nowrap">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Keranjang Belanja
                        @if($carts->count() > 0)
                            <span :class="tab === 'cart' ? 'bg-white text-orange-600' : 'bg-orange-100 text-orange-600'" class="ml-1 py-0.5 px-2.5 rounded-full text-xs font-extrabold shadow-sm">{{ $carts->count() }}</span>
                        @endif
                    </button>
                </div>
            </div>

            <!-- MAIN CONTENT AREA -->
            <div class="w-full">
                
                <!-- DASHBOARD TAB -->
                <div x-show="tab === 'orders'" 
                     x-transition:enter="transition ease-out duration-500" 
                     x-transition:enter-start="opacity-0 translate-y-8" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     style="display: none;">
                    
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="glass-dark rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden group">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Pengeluaran</p>
                                    <h4 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-yellow-500">
                                        Rp {{ number_format($orders->where('status', 'Selesai')->sum('total'), 0, ',', '.') }}
                                    </h4>
                                </div>
                                <div class="p-4 bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl text-white shadow-lg shadow-orange-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="glass-dark rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden group">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                            <div class="relative z-10 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Paket Aktif</p>
                                    <h4 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">
                                        {{ $orders->where('status', '!=', 'Selesai')->count() }} Paket
                                    </h4>
                                </div>
                                <div class="p-4 bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl text-white shadow-lg shadow-blue-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lacak Pesanan -->
                    <div class="glass-dark shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-extrabold text-gray-800">Lacak Pesanan Anda</h3>
                                <p class="text-sm text-gray-500 mt-1">Pantau status pesanan terkini Anda di sini.</p>
                            </div>
                        </div>

                        @if ($orders->isEmpty())
                            <div class="text-center py-16 bg-white/50 rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-50 text-orange-400 mb-4">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Belum Ada Transaksi</h3>
                                <p class="mt-2 text-gray-500 max-w-sm mx-auto">Anda belum memiliki pesanan yang tercatat. Yuk, mulai jelajahi menu lezat kami!</p>
                                <a href="{{ route('menu') }}" class="inline-flex items-center px-6 py-3 mt-6 text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-orange-400 rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                    Jelajahi Menu
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        @else
                            <div class="space-y-8">
                                @foreach ($orders as $order)
                                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300 overflow-hidden group">
                                        <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-5 border-b border-gray-100 flex flex-wrap items-center justify-between gap-4">
                                            <div class="flex gap-8">
                                                <div>
                                                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Tanggal</p>
                                                    <p class="font-bold text-gray-800">{{ $order->order_date->format('d M Y, H:i') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Total Belanja</p>
                                                    <p class="font-extrabold text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                @php
                                                    $statusStyles = [
                                                        'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                        'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                        'Dikirim' => 'bg-purple-100 text-purple-700 border-purple-200',
                                                        'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                                    ];
                                                    $styleClass = $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                                @endphp
                                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold border {{ $styleClass }} shadow-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full mr-2 {{ str_replace(['bg-', '-100'], ['bg-', '-500'], explode(' ', $styleClass)[0]) }}"></span>
                                                    {{ $order->status }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="p-8">
                                            <!-- Tracking Timeline -->
                                            <div class="mb-10 relative px-4">
                                                @php
                                                    $steps = ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'];
                                                    $currentIndex = array_search($order->status, $steps);
                                                    if ($currentIndex === false) $currentIndex = 0;
                                                    $progress = ($currentIndex / (count($steps) - 1)) * 100;
                                                @endphp
                                                
                                                <!-- Progress Bar Background -->
                                                <div class="absolute top-4 left-10 right-10 h-1 bg-gray-200 rounded-full z-0"></div>
                                                
                                                <!-- Active Progress Bar -->
                                                <div class="absolute top-4 left-10 h-1 bg-gradient-to-r from-orange-400 to-orange-500 rounded-full z-0 transition-all duration-1000 ease-out" style="width: calc({{ $progress }}% - 2.5rem);"></div>
                                                
                                                <!-- Steps -->
                                                <div class="relative z-10 flex justify-between">
                                                    @foreach($steps as $index => $step)
                                                        @php
                                                            $isCompleted = $index <= $currentIndex;
                                                            $isActive = $index === $currentIndex;
                                                        @endphp
                                                        <div class="flex flex-col items-center group/step w-1/4">
                                                            <div class="w-9 h-9 rounded-full flex items-center justify-center transition-all duration-300 {{ $isCompleted ? 'bg-orange-500 text-white shadow-md shadow-orange-300' : 'bg-white border-2 border-gray-200 text-gray-400' }} {{ $isActive ? 'ring-4 ring-orange-100 scale-110' : '' }}">
                                                                @if($isCompleted)
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                                @else
                                                                    <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                                                @endif
                                                            </div>
                                                            <span class="mt-3 text-xs font-bold text-center {{ $isCompleted ? 'text-gray-800' : 'text-gray-400' }}">{{ $step }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Item yang Dipesan</h4>
                                            <div class="space-y-4">
                                                @foreach ($order->orderDetails as $detail)
                                                    <div class="flex items-center gap-4 bg-gray-50/50 p-3 rounded-2xl border border-gray-50 hover:bg-gray-50 transition-colors">
                                                        <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                                                            @if($detail->menu->image)
                                                                <img src="{{ Storage::url($detail->menu->image) }}" alt="{{ $detail->menu->name }}" class="h-full w-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500">
                                                            @else
                                                                <div class="h-full w-full bg-orange-50 flex items-center justify-center">
                                                                    <svg class="h-6 w-6 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-base font-bold text-gray-800 truncate">{{ $detail->menu->name }}</p>
                                                            <p class="text-sm text-gray-500 font-medium">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-base font-extrabold text-orange-600">Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- PROFIL TAB -->
                <div x-show="tab === 'profile'" 
                     x-transition:enter="transition ease-out duration-500 delay-100" 
                     x-transition:enter-start="opacity-0 translate-y-8" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     style="display: none;">
                    
                    <!-- Profile Picture Header (moved from sidebar) -->
                    <div class="glass-dark shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl p-8 relative overflow-hidden mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-yellow-500 opacity-5"></div>
                        <div class="flex items-center gap-6 relative z-10">
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-orange-500 rounded-full blur opacity-30"></div>
                                @if (auth()->user()->profile_picture)
                                    <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile Picture" class="relative h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div class="relative h-24 w-24 rounded-full bg-orange-100 border-4 border-white shadow-lg flex items-center justify-center text-orange-600 font-extrabold text-3xl">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-extrabold text-3xl text-gray-800 tracking-tight">{{ auth()->user()->name }}</h3>
                                <p class="text-base font-medium text-orange-600 mt-1">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="glass-dark shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl p-8 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-bl-full opacity-50"></div>
                            <div class="relative z-10">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="glass-dark shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl p-8 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-100 rounded-bl-full opacity-50"></div>
                            <div class="relative z-10">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KERANJANG TAB -->
                <div x-show="tab === 'cart'" 
                     x-transition:enter="transition ease-out duration-500 delay-100" 
                     x-transition:enter-start="opacity-0 translate-y-8" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     style="display: none;">
                    
                    <div class="glass-dark shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl p-8 relative min-h-[500px] flex flex-col"
                         x-data="{ 
                                selected: [], 
                                items: [
                                    @foreach($carts as $c)
                                        { id: {{ $c->id }}, price: {{ $c->menu->price }}, quantity: {{ $c->quantity }} },
                                    @endforeach
                                ],
                                get total() {
                                    return this.items
                                        .filter(item => this.selected.includes(item.id.toString()))
                                        .reduce((sum, item) => sum + (item.price * item.quantity), 0);
                                },
                                formatPrice(price) {
                                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);
                                },
                                updateQuantity(id, delta) {
                                    let item = this.items.find(i => i.id === id);
                                    if (item) {
                                        let newQty = item.quantity + delta;
                                        if (newQty >= 1) {
                                            item.quantity = newQty;
                                            
                                            // AJAX CALL to update database silently
                                            fetch(`/cart/${id}`, {
                                                method: 'PUT',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                                                },
                                                body: JSON.stringify({ quantity: newQty })
                                            }).catch(err => console.error(err));
                                        }
                                    }
                                },
                                getSubtotal(id) {
                                    let item = this.items.find(i => i.id === id);
                                    if (item) {
                                        return this.formatPrice(item.price * item.quantity);
                                    }
                                    return 'Rp 0';
                                }
                            }">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-extrabold text-gray-800">Keranjang Belanja</h3>
                                <p class="text-sm text-gray-500 mt-1">Pilih menu yang ingin Anda nikmati sekarang.</p>
                            </div>
                            <span class="px-4 py-1.5 bg-orange-100 text-orange-800 rounded-full text-sm font-bold shadow-sm">{{ $carts->count() }} Menu</span>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($carts->isEmpty())
                            <div class="flex-1 flex flex-col items-center justify-center text-center py-12">
                                <div class="w-32 h-32 mb-6 bg-orange-50 rounded-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Keranjang Masih Kosong</h3>
                                <p class="text-gray-500 max-w-sm mb-8">Saatnya mengisi keranjang dengan hidangan lezat favorit Anda!</p>
                                <a href="{{ route('menu') }}" class="inline-flex items-center px-8 py-3.5 text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-orange-400 rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                    Mulai Belanja
                                </a>
                            </div>
                        @else
                            <div class="space-y-4 mb-24 flex-1">
                                @foreach ($carts as $cart)
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-6 bg-white p-5 rounded-2xl border border-gray-100 hover:border-orange-200 hover:shadow-lg transition-all duration-300 shadow-sm relative group">
                                        
                                        <!-- Checkbox area (clickable to select) -->
                                        <label class="flex items-center gap-4 cursor-pointer sm:w-auto w-full">
                                            <div class="flex-shrink-0 pl-1">
                                                <input type="checkbox" value="{{ $cart->id }}" x-model="selected" class="custom-checkbox">
                                            </div>
                                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl shadow-sm">
                                                @if($cart->menu->image)
                                                    <img src="{{ Storage::url($cart->menu->image) }}" alt="{{ $cart->menu->name }}" class="h-full w-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500">
                                                @else
                                                    <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0 sm:hidden block">
                                                <h4 class="text-base font-bold text-gray-800">{{ $cart->menu->name }}</h4>
                                                <p class="text-xs font-medium text-gray-500 mt-1">Rp {{ number_format($cart->menu->price, 0, ',', '.') }}</p>
                                            </div>
                                        </label>

                                        <!-- Details -->
                                        <div class="flex-1 min-w-0 hidden sm:block">
                                            <h4 class="text-lg font-bold text-gray-800">{{ $cart->menu->name }}</h4>
                                            <p class="text-sm font-medium text-gray-500 mt-1">Rp {{ number_format($cart->menu->price, 0, ',', '.') }} / porsi</p>
                                        </div>

                                        <!-- Actions (+ / - and Delete) -->
                                        <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto mt-2 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-0 border-gray-100">
                                            
                                            <!-- Delete Form -->
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 p-2.5 rounded-xl transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>

                                            <!-- Update Quantity Div -->
                                            <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 p-1">
                                                <button type="button" @click.stop="updateQuantity({{ $cart->id }}, -1)" class="px-3 py-1.5 text-gray-500 hover:text-orange-600 transition-colors bg-white rounded-lg shadow-sm font-bold">-</button>
                                                <input type="number" readonly :value="items.find(i => i.id === {{ $cart->id }})?.quantity" class="w-10 text-center bg-transparent border-none focus:ring-0 text-sm font-bold p-0 text-gray-900 mx-1 cursor-default select-none pointer-events-none" />
                                                <button type="button" @click.stop="updateQuantity({{ $cart->id }}, 1)" class="px-3 py-1.5 text-gray-500 hover:text-orange-600 transition-colors bg-white rounded-lg shadow-sm font-bold">+</button>
                                            </div>

                                            <!-- Subtotal -->
                                            <div class="text-right flex-shrink-0 min-w-[100px] hidden sm:block">
                                                <p class="text-lg font-extrabold text-orange-600" x-text="getSubtotal({{ $cart->id }})"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Sticky Bottom Checkout Bar -->
                            <div class="absolute bottom-0 left-0 right-0 bg-white/90 backdrop-blur-md border-t border-gray-100 p-5 rounded-b-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.08)] flex flex-col sm:flex-row justify-between items-center gap-4 z-20">
                                <div class="flex items-center gap-3">
                                    <div class="p-3 bg-orange-50 rounded-xl text-orange-500 hidden sm:block">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Total Pembayaran</p>
                                        <p class="text-xl sm:text-2xl font-extrabold text-orange-600 leading-none mt-1" x-text="formatPrice(total)"></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                    <p class="text-sm font-bold text-gray-600">
                                        <span x-text="selected.length" class="text-orange-600 text-lg"></span> item dipilih
                                    </p>
                                    <form action="{{ route('checkout') }}" method="POST" class="w-auto">
                                        @csrf
                                        <template x-for="id in selected">
                                            <input type="hidden" name="cart_ids[]" :value="id">
                                        </template>
                                        <button type="submit" 
                                                :disabled="selected.length === 0" 
                                                :class="selected.length === 0 ? 'opacity-50 cursor-not-allowed saturate-0' : 'hover:shadow-lg hover:shadow-orange-300 hover:-translate-y-0.5'" 
                                                class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 text-sm sm:text-base font-bold text-white bg-gradient-to-r from-orange-600 to-orange-500 rounded-2xl transition-all duration-300">
                                            Periksa Sekarang <span class="hidden sm:inline">&rarr;</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
