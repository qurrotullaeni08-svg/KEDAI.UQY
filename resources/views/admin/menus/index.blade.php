@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-black text-gray-900">Kelola Menu</h1>
        <p class="text-gray-500 mt-1">Daftar semua menu yang tersedia di Kedai Uqy.</p>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="px-5 py-2.5 rounded-xl bg-orange-600 text-white font-bold hover:bg-orange-700 transition-colors shadow-sm flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Menu Baru
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Gambar</th>
                    <th class="px-6 py-3 font-semibold">Nama Menu</th>
                    <th class="px-6 py-3 font-semibold">Kategori</th>
                    <th class="px-6 py-3 font-semibold">Harga</th>
                    <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($menus as $menu)
                <tr class="hover:bg-orange-50/40 transition-colors group">
                    <td class="px-6 py-4">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="w-14 h-14 object-cover rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-14 h-14 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-gray-400 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-6 h-6 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-gray-900 text-base">{{ $menu->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-gray-200 shadow-sm">{{ $menu->category }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-orange-600 text-base">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white hover:shadow-md hover:shadow-blue-500/30 rounded-lg transition-all duration-300" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-600 hover:text-white hover:shadow-md hover:shadow-red-500/30 rounded-lg transition-all duration-300" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-700">Belum ada data menu</h3>
                            <p class="text-sm text-gray-500 mt-1 mb-3">Tambahkan menu pertama Anda untuk mulai berjualan.</p>
                            <a href="{{ route('admin.menus.create') }}" class="px-4 py-2 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 hover:shadow-md transition-all text-sm">Tambah Menu Baru</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($menus->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
        {{ $menus->links() }}
    </div>
    @endif
</div>
@endsection
