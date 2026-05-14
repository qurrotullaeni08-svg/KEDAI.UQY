@extends('layouts.app')

@section('content')
    <div
        class="mb-6 relative overflow-hidden bg-gradient-to-r from-orange-600 to-orange-400 rounded-2xl p-6 text-white shadow-sm">
        <div class="relative z-10">
            <h1 class="text-2xl font-black mb-1">Dashboard Kedai Uqy</h1>
            <p class="text-orange-100 opacity-90 text-sm">Ringkasan aktivitas dan performa toko Anda hari ini.</p>
        </div>
        <!-- Decorative Circle -->
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute right-20 -bottom-10 w-24 h-24 bg-orange-700/20 rounded-full blur-xl"></div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div
            class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-100 to-orange-50 text-orange-600 flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pesanan</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $totalOrders }} <span
                            class="text-sm font-medium text-gray-400 normal-case">trx</span></h3>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 text-green-600 flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-gray-900"><span
                            class="text-sm">Rp</span>{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Menu</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $totalMenus }} <span
                            class="text-sm font-medium text-gray-400 normal-case">item</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">Pesanan Terbaru</h2>
            </div>
            <a href="{{ route('admin.orders') }}"
                class="text-xs font-bold text-orange-600 hover:text-orange-700 bg-orange-50 px-3 py-1.5 rounded-full transition-colors">Lihat
                Semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 font-semibold">ID Pesanan</th>
                        <th class="px-6 py-3 font-semibold">Pelanggan</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-orange-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-800 group-hover:bg-orange-100 group-hover:text-orange-800 transition-colors">
                                    #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-700">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 text-xs text-gray-500 font-medium">
                                {{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-right font-bold text-orange-600 text-base">Rp
                                {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center text-gray-400">
                                <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <p class="text-lg font-medium">Belum ada pesanan masuk hari ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection