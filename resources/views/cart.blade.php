@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="bg-gray-950 py-12 relative overflow-hidden -mt-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-3xl md:text-4xl font-black text-white mb-2 tracking-tight">Keranjang <span class="text-orange-500">Belanja</span></h1>
        <p class="text-gray-400 text-lg">Periksa kembali pesanan Anda sebelum melakukan pembayaran.</p>
    </div>
</div>

<!-- Main Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-start" x-data="{ show: true }" x-show="show" x-transition>
                <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="flex-1">
                    <h3 class="text-green-800 font-bold text-lg">Berhasil!</h3>
                    <p class="text-green-700 mt-1">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm flex items-start" x-data="{ show: true }" x-show="show" x-transition>
                <svg class="w-6 h-6 text-red-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="flex-1">
                    <h3 class="text-red-800 font-bold text-lg">Gagal!</h3>
                    <p class="text-red-700 mt-1">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
        @endif

        @if($carts->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-24 h-24 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Keranjang masih kosong</h3>
                <p class="text-gray-500 mb-8">Anda belum menambahkan makanan ke dalam keranjang.</p>
                <a href="{{ route('menu') }}" class="inline-flex items-center px-8 py-4 rounded-full font-bold text-white bg-orange-600 hover:bg-orange-700 transition-all shadow-lg hover:-translate-y-1">
                    Lihat Menu Makanan
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach($carts as $cart)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex flex-col sm:flex-row items-center gap-6 hover:shadow-md transition-shadow">
                            <!-- Image -->
                            <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden">
                                @if($cart->menu->image)
                                    <img src="{{ asset('storage/' . $cart->menu->image) }}" alt="{{ $cart->menu->name }}" class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Details -->
                            <div class="flex-grow w-full text-center sm:text-left">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $cart->menu->name }}</h3>
                                <p class="text-gray-500 text-sm mb-3">Rp {{ number_format($cart->menu->price, 0, ',', '.') }}</p>
                                
                                <div class="flex items-center justify-center sm:justify-start gap-4">
                                    <!-- Update Form -->
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center bg-gray-50 rounded-lg border border-gray-200">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit();" class="px-3 py-1 text-gray-500 hover:text-orange-600 transition-colors">-</button>
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" onchange="this.form.submit()" class="w-12 text-center bg-transparent border-none focus:ring-0 text-sm font-bold p-0 text-gray-900" />
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit();" class="px-3 py-1 text-gray-500 hover:text-orange-600 transition-colors">+</button>
                                    </form>

                                    <!-- Delete Form -->
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Subtotal -->
                            <div class="w-full sm:w-auto text-center sm:text-right mt-4 sm:mt-0 border-t sm:border-t-0 border-gray-100 pt-4 sm:pt-0">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Subtotal</p>
                                <p class="text-lg font-black text-gray-900">Rp {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sticky top-28">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>
                        
                        <div class="space-y-4 mb-6 border-b border-gray-100 pb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Item</span>
                                <span class="font-bold">{{ $carts->sum('quantity') }} item</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Total Harga</span>
                                <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Diskon</span>
                                <span class="font-bold">Rp 0</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mb-8">
                            <span class="text-gray-900 font-bold text-lg">Total Pembayaran</span>
                            <span class="text-3xl font-black text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            @foreach($carts as $cart)
                                <input type="hidden" name="cart_ids[]" value="{{ $cart->id }}">
                            @endforeach
                            <button type="submit" class="w-full py-4 rounded-xl font-bold text-white bg-orange-600 hover:bg-orange-700 transition-all shadow-[0_8px_20px_rgba(234,88,12,0.3)] hover:-translate-y-1 text-lg flex items-center justify-center">
                                Lanjut Pembayaran
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
