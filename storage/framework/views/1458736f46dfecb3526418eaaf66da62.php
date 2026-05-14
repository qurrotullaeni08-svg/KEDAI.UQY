<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="bg-gray-950 py-16 relative overflow-hidden -mt-6">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1495195129379-137233cde244?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Header Background" class="w-full h-full object-cover opacity-20" />
        <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 to-gray-900/50"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Daftar <span class="text-orange-500">Menu</span></h1>
        <div class="w-20 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg">Pilih dan nikmati berbagai hidangan lezat yang disiapkan spesial dengan resep rahasia kami.</p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if(session('success')): ?>
            <div class="mb-10 bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm flex items-start" x-data="{ show: true }" x-show="show" x-transition>
                <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="flex-1">
                    <h3 class="text-green-800 font-bold text-lg">Berhasil!</h3>
                    <p class="text-green-700 mt-1"><?php echo e(session('success')); ?></p>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
        <?php endif; ?>

        <?php if($menus->isEmpty()): ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum ada menu</h3>
                <p class="text-gray-500">Menu belum tersedia saat ini. Silakan kembali lagi nanti.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                        <div class="relative h-60 overflow-hidden bg-white flex items-center justify-center p-2 border-b border-gray-50">
                            <?php if($menu->image): ?>
                                <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-sm" />
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider text-orange-600 shadow-sm border border-orange-100">
                                <?php echo e($menu->category); ?>

                            </div>
                        </div>
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($menu->name); ?></h3>
                                <span class="text-lg font-black text-orange-600">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></span>
                            </div>
                            
                            <div class="mt-auto flex gap-3">
                                <?php if(auth()->guard()->check()): ?>
                                    <!-- Tambah Keranjang -->
                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="shrink-0">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="menu_id" value="<?php echo e($menu->id); ?>">
                                        <button type="submit" title="Tambah ke Keranjang" class="w-14 h-14 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300 flex items-center justify-center border border-orange-200 hover:border-orange-600 shadow-sm group-hover:shadow">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </button>
                                    </form>
                                    
                                    <!-- Pesan Sekarang -->
                                    <a href="https://api.whatsapp.com/send?phone=6289503095910&text=<?php echo e(urlencode('Halo *Kedai Uqy*, saya ingin langsung pesan menu ini:' . "\n\n" . '*- ' . $menu->name . '* (Rp ' . number_format($menu->price, 0, ',', '.') . ')' . "\n\n" . 'Mohon informasinya ya, terima kasih!')); ?>" target="_blank" class="flex-1 rounded-xl text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 font-bold transition-all shadow-md shadow-orange-500/30 hover:shadow-orange-600/40 hover:-translate-y-0.5 flex items-center justify-center">
                                        Pesan Sekarang
                                    </a>
                                <?php else: ?>
                                    <button type="button" @click="$dispatch('open-login-modal')" title="Login untuk menambah ke keranjang" class="w-14 h-14 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition-all duration-300 flex items-center justify-center border border-orange-200 hover:border-orange-600 shadow-sm shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                    <button type="button" @click="$dispatch('open-login-modal')" class="flex-1 rounded-xl text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 font-bold transition-all shadow-md shadow-orange-500/30 hover:shadow-orange-600/40 hover:-translate-y-0.5 flex items-center justify-center">
                                        Pesan Sekarang
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-16">
                <?php echo e($menus->links()); ?>

            </div>
        <?php endif; ?>

        <!-- Custom Menu Request CTA -->
        <div class="mt-20 bg-gradient-to-br from-orange-600 to-orange-500 rounded-3xl p-8 md:p-12 shadow-xl shadow-orange-500/10 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 border border-orange-400/30">
            <!-- Decorative circle -->
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 text-center md:text-left flex-1">
                <div class="inline-flex items-center justify-center p-3 bg-white/20 backdrop-blur-md rounded-2xl text-white mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 class="text-3xl font-black text-white mb-3">Pesanan Khusus?</h3>
                <p class="text-orange-50 text-lg max-w-2xl">Memiliki request menu khusus? Hubungi kami, dan kami siap menyesuaikannya untuk Anda.</p>
            </div>
            
            <div class="relative z-10 shrink-0 w-full md:w-auto">
                <a href="https://api.whatsapp.com/send?phone=6289503095910&text=<?php echo e(urlencode('Halo *Kedai Uqy*, saya memiliki request menu khusus/custom catering untuk acara saya. Boleh minta informasinya?')); ?>" target="_blank" class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-orange-600 font-extrabold text-lg rounded-2xl hover:bg-gray-50 hover:scale-105 transition-all duration-300 shadow-lg group">
                    <svg class="w-6 h-6 mr-3 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Hubungi WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kedai-uqy\resources\views/menu.blade.php ENDPATH**/ ?>