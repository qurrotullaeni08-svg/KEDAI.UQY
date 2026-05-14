@extends('layouts.app', ['header' => 'Laporan Penjualan'])

@section('content')
<div class="space-y-6">
    <!-- Ringkasan Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pesanan</p>
                <h4 class="text-3xl font-black text-gray-800">{{ $totalOrders }}</h4>
            </div>
            <div class="p-4 bg-orange-50 text-orange-600 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                <h4 class="text-3xl font-black text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
            </div>
            <div class="p-4 bg-green-50 text-green-600 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Pesanan Selesai</p>
                <h4 class="text-3xl font-black text-blue-600">{{ $completedOrders }}</h4>
            </div>
            <div class="p-4 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Filter & Action -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <form method="GET" action="{{ route('admin.laporan') }}" class="flex flex-wrap items-end gap-4 w-full sm:w-auto">
            <div>
                <label for="start_date" class="block text-sm font-bold text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm w-full">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-bold text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm w-full">
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <button type="submit" class="flex-1 sm:flex-none px-6 py-2.5 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-colors shadow-sm">
                    Filter
                </button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ route('admin.laporan') }}" class="px-4 py-2.5 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors shadow-sm text-center flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('admin.laporan.print', request()->query()) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition-colors shadow-md hover:shadow-orange-500/30">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Laporan
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="p-4 text-xs font-black text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                        <th class="p-4 text-xs font-black text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="p-4 text-xs font-black text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="p-4 text-xs font-black text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-black text-gray-500 uppercase tracking-wider text-right">Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-4">
                            <span class="font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            {{ $order->order_date->format('d M Y, H:i') }}
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $order->user->name }}</div>
                        </td>
                        <td class="p-4">
                            @php
                                $statusStyles = [
                                    'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-700',
                                    'Diproses' => 'bg-blue-100 text-blue-700',
                                    'Dikirim' => 'bg-purple-100 text-purple-700',
                                    'Selesai' => 'bg-green-100 text-green-700',
                                ];
                                $styleClass = $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full {{ $styleClass }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <span class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Tidak ada data pesanan pada periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
