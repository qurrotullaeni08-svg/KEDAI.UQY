@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center">
    <a href="{{ route('admin.menus') }}" class="mr-4 p-2 text-gray-400 bg-white shadow-sm hover:text-blue-600 hover:shadow-md hover:scale-105 rounded-xl transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-2xl font-black text-gray-900">Edit Menu</h1>
        <p class="text-gray-500 mt-1 text-sm">Perbarui data menu {{ $menu->name }}.</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/40 overflow-hidden max-w-3xl relative">
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-blue-600"></div>
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Nama Menu -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Menu <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $menu->name) }}" required class="w-full px-4 py-3 bg-gray-50/50 rounded-xl border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-gray-800 font-medium text-base placeholder-gray-400">
                @error('name') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kategori <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="category" required class="w-full px-4 py-3 appearance-none bg-gray-50/50 rounded-xl border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-gray-800 font-medium text-base">
                            <option value="Makanan" {{ old('category', $menu->category) == 'Makanan' ? 'selected' : '' }}>🍔 Makanan</option>
                            <option value="Minuman" {{ old('category', $menu->category) == 'Minuman' ? 'selected' : '' }}>🍹 Minuman</option>
                            <option value="Snack" {{ old('category', $menu->category) == 'Snack' ? 'selected' : '' }}>🍟 Snack</option>
                            <option value="Dessert" {{ old('category', $menu->category) == 'Dessert' ? 'selected' : '' }}>🍨 Dessert</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('category') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">Rp</span>
                        </div>
                        <input type="number" name="price" value="{{ old('price', $menu->price) }}" required min="0" class="w-full pl-11 pr-4 py-3 bg-gray-50/50 rounded-xl border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-gray-800 font-bold text-base placeholder-gray-400">
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Gambar -->
            <!-- Gambar -->
            <div x-data="{ 
                imageUrl: '{{ $menu->image ? asset('storage/' . $menu->image) : '' }}',
                isNewImage: false,
                clearImage() { 
                    this.imageUrl = null; 
                    this.isNewImage = false;
                    document.getElementById('file-upload').value = ''; 
                } 
            }">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Gambar Menu <span class="text-gray-400 font-normal normal-case">(Opsional)</span></label>
                
                <!-- Dropzone (hanya tampil jika BELUM ada gambar atau sudah dihapus) -->
                <div x-show="!imageUrl" style="display: none;" class="mt-1.5 flex justify-center px-6 pt-6 pb-8 border-2 border-gray-200 border-dashed rounded-2xl hover:border-blue-500 hover:bg-blue-50/30 transition-colors bg-gray-50/50 group">
                    <div class="space-y-2 text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto shadow-sm group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-6 w-6 text-gray-400 group-hover:text-blue-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="flex text-sm text-gray-600 justify-center items-center mt-3">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-lg font-bold text-blue-600 hover:text-blue-500 px-3 py-1.5 border border-blue-100 shadow-sm hover:shadow transition-all text-sm">
                                <span>Pilih Gambar Baru</span>
                                <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" @change="if($event.target.files.length) { imageUrl = URL.createObjectURL($event.target.files[0]); isNewImage = true; }">
                            </label>
                            <p class="pl-2 py-1 font-medium text-gray-500 text-sm">atau drag & drop</p>
                        </div>
                        <p class="text-xs font-bold text-gray-400 mt-1">PNG, JPG, JPEG maks 2MB</p>
                    </div>
                </div>

                <!-- Preview Gambar (hanya tampil jika SUDAH ada gambar) -->
                <div x-cloak x-show="imageUrl" class="mt-2 relative rounded-2xl overflow-hidden border-2 border-blue-200 group inline-block max-w-full">
                    <img :src="imageUrl" class="w-full max-w-md h-64 object-cover">
                    
                    <!-- Indikator Gambar Baru/Lama -->
                    <div class="absolute top-3 left-3">
                        <span x-show="!isNewImage" class="bg-gray-900/70 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full">Gambar Saat Ini</span>
                        <span x-show="isNewImage" style="display: none;" class="bg-green-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">Gambar Baru</span>
                    </div>

                    <!-- Overlay dan Tombol Silang (Remove) -->
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                        <button type="button" @click="clearImage()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-lg transition-transform hover:scale-110 focus:outline-none flex items-center gap-2 font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Ganti Gambar
                        </button>
                    </div>
                </div>

                @error('image') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
            <a href="{{ route('admin.menus') }}" class="px-6 py-3 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-900 font-bold transition-colors text-sm">Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 font-bold transition-all shadow-md shadow-blue-500/30 hover:shadow-blue-600/40 hover:-translate-y-0.5 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
