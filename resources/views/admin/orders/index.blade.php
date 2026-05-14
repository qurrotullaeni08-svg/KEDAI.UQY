@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-black text-gray-900">Daftar Pesanan</h1>
    <p class="text-gray-500 mt-1">Kelola dan pantau seluruh pesanan pelanggan.</p>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <span class="font-bold">{{ session('success') }}</span>
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">ID Pesanan</th>
                    <th class="px-6 py-3 font-semibold">Pelanggan</th>
                    <th class="px-6 py-3 font-semibold">Waktu Order</th>
                    <th class="px-6 py-3 font-semibold">Detail Menu</th>
                    <th class="px-6 py-3 font-semibold text-center">Status</th>
                    <th class="px-6 py-3 font-semibold text-right">Total Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($orders as $order)
                <tr class="hover:bg-orange-50/40 transition-colors align-top group">
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-800 group-hover:bg-orange-100 group-hover:text-orange-800 transition-colors shadow-sm">
                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center text-orange-600 font-bold shadow-sm text-xs">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-500 font-medium">{{ $order->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-gray-900 font-semibold">{{ $order->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500 font-medium">{{ $order->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td class="px-6 py-4">
                        <ul class="space-y-1.5 text-xs text-gray-600 bg-gray-50 p-3 rounded-xl border border-gray-100">
                            @foreach($order->orderDetails as $detail)
                                <li class="flex items-start">
                                    <span class="font-bold text-orange-600 bg-orange-50 px-1.5 py-0.5 rounded mr-2">{{ $detail->quantity }}x</span> 
                                    <span class="font-medium text-gray-700 mt-0.5">{{ $detail->menu->name ?? 'Menu Dihapus' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-xl border-gray-200 shadow-sm focus:ring-orange-500 focus:border-orange-500 py-2 px-4 pr-8 cursor-pointer hover:bg-gray-50 transition-colors
                                {{ $order->status == 'Menunggu Konfirmasi' ? 'bg-yellow-50 text-yellow-700 border-yellow-200 hover:bg-yellow-100' : '' }}
                                {{ $order->status == 'Diproses' ? 'bg-blue-50 text-blue-700 border-blue-200 hover:bg-blue-100' : '' }}
                                {{ $order->status == 'Dikirim' ? 'bg-purple-50 text-purple-700 border-purple-200 hover:bg-purple-100' : '' }}
                                {{ $order->status == 'Selesai' ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : '' }}
                            ">
                                <option value="Menunggu Konfirmasi" {{ $order->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Dikirim" {{ $order->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="inline-block bg-green-50 px-3 py-1.5 rounded-xl border border-green-100 shadow-sm">
                            <span class="font-bold text-base text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-700">Belum ada pesanan</h3>
                            <p class="text-sm text-gray-500 mt-1">Pesanan pelanggan akan otomatis muncul di sini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
