<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section id="home" class="relative min-h-[80vh] md:min-h-[90vh] flex items-center justify-center overflow-hidden -mt-6">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo e(asset('images/sundanese_food_hero.png')); ?>" alt="Makanan Sunda background"
                class="w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-r from-gray-950/95 via-gray-900/80 to-gray-900/40"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 w-full">
            <div class="md:w-2/3 lg:w-1/2 text-center md:text-left mx-auto md:mx-0">
                <div
                    class="inline-flex items-center py-1.5 px-5 rounded-full bg-orange-500/20 text-orange-400 text-sm font-bold tracking-widest uppercase mb-7 border border-orange-500/30 backdrop-blur-md shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-orange-500 mr-2.5 animate-pulse"></span>
                    Rasa Terbaik Kota Ini
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] mb-6">
                    Nikmati Makanan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-300">Favoritmu</span>
                    Setiap Hari
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-lg mx-auto md:mx-0 leading-relaxed">
                    Kedai Uqy menyajikan hidangan lezat dengan resep rahasia yang dijamin akan memanjakan lidah Anda. Pesan
                    sekarang dan rasakan kenikmatannya!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#menu"
                        class="px-9 py-4 rounded-full font-bold text-white bg-orange-600 hover:bg-orange-700 transition-all duration-300 shadow-[0_0_20px_rgba(234,88,12,0.4)] hover:shadow-[0_0_30px_rgba(234,88,12,0.6)] hover:-translate-y-1 flex items-center justify-center group">
                        Lihat Menu Kami
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section id="menu" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Menu Pilihan <span
                        class="text-orange-600">Terbaik</span></h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Kami menggunakan bahan-bahan berkualitas tinggi untuk
                    menyajikan makanan dengan cita rasa tak tertandingi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                        <div class="relative h-64 overflow-hidden bg-white flex items-center justify-center p-2 border-b border-gray-50">
                            <?php if($menu->image): ?>
                                <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-sm" />
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-black tracking-wider uppercase text-orange-600 shadow-sm border border-orange-100">
                                <?php echo e($menu->category); ?>

                            </div>
                        </div>
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight"><?php echo e($menu->name); ?></h3>
                                </div>
                                <span class="text-xl font-black text-orange-600 block mb-6">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></span>
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

            <div class="mt-16 text-center">
                <a href="<?php echo e(route('menu')); ?>"
                    class="inline-flex items-center justify-center text-orange-600 font-bold text-lg hover:text-orange-700 transition-colors group">
                    Lihat Menu Lengkap
                    <svg class="w-6 h-6 ml-2 group-hover:translate-x-2 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Paket Catering -->
    <section id="catering" class="py-24 bg-orange-50/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Paket Catering <span
                        class="text-orange-600">Kedai UQY</span></h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Solusi praktis dan lezat untuk segala kebutuhan acara
                    Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 justify-center">
                <!-- Paket 1: Catering Box -->
                <div
                    class="bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                    <div class="relative h-72 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-orange-50">
                        <img src="<?php echo e(asset('storage/menus/catering_box.jpg')); ?>"
                            alt="Catering Box"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md p-2" />
                        <div
                            class="absolute top-4 right-4 bg-orange-500/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-black tracking-wider uppercase text-white shadow-sm">
                            Favorit</div>
                    </div>
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">Catering Box</h3>
                                <span class="text-lg font-black text-orange-600">Rp 25.000</span>
                            </div>
                            <p class="text-gray-500 mb-6 leading-relaxed">Pilihan praktis berupa nasi box dengan lauk
                                lengkap (Ayam Bakar/Goreng, Sayur, Sambal, Kerupuk).</p>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="https://wa.me/6289503095910?text=Halo%20Kedai%20UQY,%20saya%20ingin%20pesan%20Paket%20Catering%20Box"
                                target="_blank"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </a>
                        <?php else: ?>
                            <button type="button" @click="$dispatch('open-login-modal')"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Paket 2: Snack Box -->
                <div
                    class="bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                    <div class="relative h-72 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-orange-50">
                        <img src="<?php echo e(asset('storage/menus/snack_box.jpg')); ?>"
                            alt="Snack Box"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md p-2" />
                    </div>
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">Snack Box</h3>
                                <span class="text-lg font-black text-orange-600">Rp 15.000</span>
                            </div>
                            <p class="text-gray-500 mb-6 leading-relaxed">Kue manis, gurih, dan air mineral, cocok untuk
                                meeting kantor atau acara kumpul santai bersama teman.</p>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="https://wa.me/6289503095910?text=Halo%20Kedai%20UQY,%20saya%20ingin%20pesan%20Paket%20Snack%20Box"
                                target="_blank"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </a>
                        <?php else: ?>
                            <button type="button" @click="$dispatch('open-login-modal')"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Paket 3: Dessert Box -->
                <div
                    class="bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
                    <div class="relative h-72 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-orange-50">
                        <img src="<?php echo e(asset('storage/menus/dessert_box.jpg')); ?>"
                            alt="Dessert Box"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md p-2" />
                    </div>
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">Dessert Box</h3>
                                <span class="text-lg font-black text-orange-600">Rp 35.000</span>
                            </div>
                            <p class="text-gray-500 mb-6 leading-relaxed">Berbagai varian manis dari tiramisu, choco lava,
                                hingga red velvet untuk pencuci mulut yang spesial.</p>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="https://wa.me/6289503095910?text=Halo%20Kedai%20UQY,%20saya%20ingin%20pesan%20Paket%20Dessert%20Box"
                                target="_blank"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </a>
                        <?php else: ?>
                            <button type="button" @click="$dispatch('open-login-modal')"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Pesan Sekarang
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Paket 4: Catering Acara -->
                <div
                    class="bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col md:col-span-2 lg:col-span-1">
                    <div class="relative h-72 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-orange-50">
                        <img src="<?php echo e(asset('storage/menus/catering_acara.jpg')); ?>"
                            alt="Catering Acara Tasyakuran"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md p-2" />
                        <div
                            class="absolute top-4 right-4 bg-orange-600/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-black tracking-wider uppercase text-white shadow-sm">
                            Premium</div>
                    </div>
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">Catering Acara Tasyakuran</h3>
                                <span class="text-lg font-black text-orange-600">Mulai Rp 50k/pax</span>
                            </div>
                            <p class="text-gray-500 mb-6 leading-relaxed">Menu prasmanan mewah untuk pernikahan, khitanan,
                                atau acara spesial lainnya dengan cita rasa bintang lima.</p>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="https://wa.me/6289503095910?text=Halo%20Kedai%20UQY,%20saya%20ingin%20tanya%20mengenai%20Paket%20Catering%20Acara"
                                target="_blank"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Hubungi Kami
                            </a>
                        <?php else: ?>
                            <button type="button" @click="$dispatch('open-login-modal')"
                                class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                Hubungi Kami
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Paket 5: Catering Harian -->
                <div
                    class="bg-white rounded-3xl shadow-xl border border-orange-100 overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col md:col-span-2 lg:col-span-1">
                    <div class="relative h-72 overflow-hidden bg-gray-50 flex items-center justify-center border-b border-orange-50">
                        <img src="<?php echo e(asset('storage/menus/catering_harian.jpg')); ?>"
                            alt="Catering Harian"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md p-2" />
                    </div>
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">Catering Harian</h3>
                                <span class="text-lg font-black text-orange-600">Rp 400k/minggu</span>
                            </div>
                            <p class="text-gray-500 mb-6 leading-relaxed">Menu berganti setiap hari yang bernutrisi untuk
                                makan siang di kantor atau di rumah. Bebas bosan!</p>
                        </div>
                        <a href="https://wa.me/6289503095910?text=Halo%20Kedai%20UQY,%20saya%20ingin%20berlangganan%20Paket%20Catering%20Harian"
                            target="_blank"
                            class="w-full py-3.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-600 font-bold hover:bg-orange-500 hover:text-white transition-all duration-300 flex items-center justify-center group-hover:shadow-[0_8px_20px_rgba(234,88,12,0.3)] mt-6">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Berlangganan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Kenapa Memilih <span
                        class="text-orange-600">Kami?</span></h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Keunggulan layanan yang membuat pelanggan selalu kembali.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 hover:shadow-[0_10px_40px_rgba(234,88,12,0.1)] hover:border-orange-200 transition-all duration-300 text-center group">
                    <div
                        class="w-20 h-20 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 transform group-hover:-rotate-3 group-hover:scale-110 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kualitas Premium</h3>
                    <p class="text-gray-500 leading-relaxed">Menggunakan bahan-bahan segar pilihan untuk menjamin cita rasa
                        dan kualitas terbaik di setiap sajian.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 hover:shadow-[0_10px_40px_rgba(234,88,12,0.1)] hover:border-orange-200 transition-all duration-300 text-center group">
                    <div
                        class="w-20 h-20 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 transform group-hover:scale-110 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pengiriman Cepat</h3>
                    <p class="text-gray-500 leading-relaxed">Pesanan Anda akan diantar secepat kilat dalam kondisi masih
                        hangat langsung ke depan pintu Anda.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 hover:shadow-[0_10px_40px_rgba(234,88,12,0.1)] hover:border-orange-200 transition-all duration-300 text-center group">
                    <div
                        class="w-20 h-20 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 transform group-hover:rotate-3 group-hover:scale-110 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Harga Terjangkau</h3>
                    <p class="text-gray-500 leading-relaxed">Menawarkan makanan berkualitas sekelas restoran mewah namun
                        dengan harga yang pas di kantong pelajar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Pemesanan -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Cara <span
                        class="text-orange-600">Pemesanan</span></h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Nikmati hidangan lezat dalam 3 langkah mudah yang tidak
                    merepotkan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center relative">
                <div
                    class="hidden md:block absolute top-12 left-[16%] right-[16%] h-1 bg-gradient-to-r from-orange-100 via-orange-300 to-orange-100 rounded-full -z-10">
                </div>
                <div class="relative z-10 flex flex-col items-center group">
                    <div
                        class="w-24 h-24 bg-white text-orange-600 rounded-full flex items-center justify-center text-3xl font-black shadow-[0_0_30px_rgba(234,88,12,0.15)] border-8 border-gray-50 mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        1</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pilih Menu</h3>
                    <p class="text-gray-500 px-4">Pilih makanan favorit Anda dari daftar menu kami yang menggugah selera.
                    </p>
                </div>
                <div class="relative z-10 flex flex-col items-center mt-12 md:mt-0 group">
                    <div
                        class="w-24 h-24 bg-white text-orange-600 rounded-full flex items-center justify-center text-3xl font-black shadow-[0_0_30px_rgba(234,88,12,0.15)] border-8 border-gray-50 mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 delay-100">
                        2</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Checkout</h3>
                    <p class="text-gray-500 px-4">Lakukan pembayaran dengan metode yang aman, praktis dan nyaman.</p>
                </div>
                <div class="relative z-10 flex flex-col items-center mt-12 md:mt-0 group">
                    <div
                        class="w-24 h-24 bg-white text-orange-600 rounded-full flex items-center justify-center text-3xl font-black shadow-[0_0_30px_rgba(234,88,12,0.15)] border-8 border-gray-50 mb-8 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 delay-200">
                        3</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pesanan Diantar</h3>
                    <p class="text-gray-500 px-4">Tunggu dengan santai, kurir kami akan segera tiba di tempat Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="py-24 bg-gray-950 text-white relative overflow-hidden">
        <!-- Background Texture (Grid Dots) -->
        <div class="absolute inset-0 z-0 opacity-[0.15]" style="background-image: radial-gradient(rgba(255, 255, 255, 1) 1px, transparent 1px); background-size: 32px 32px;"></div>
        
        <!-- Floating Animated Gradients -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0) scale(1); }
                50% { transform: translateY(-40px) scale(1.05); }
            }
            @keyframes float-delayed {
                0%, 100% { transform: translateY(0) scale(1); }
                50% { transform: translateY(40px) scale(0.95); }
            }
            .animate-float { animation: float 10s ease-in-out infinite; }
            .animate-float-delayed { animation: float-delayed 12s ease-in-out infinite; }
        </style>
        
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-600 rounded-full mix-blend-screen filter blur-[150px] opacity-20 -translate-x-1/2 -translate-y-1/4 animate-float pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-yellow-500 rounded-full mix-blend-screen filter blur-[150px] opacity-10 translate-x-1/4 translate-y-1/4 animate-float-delayed pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Apa Kata <span class="text-orange-500">Pelanggan</span> Kami?</h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-orange-100/80 mt-6 text-lg md:text-xl font-medium tracking-wide">✨ “Lebih dari 500 pelanggan puas dengan layanan catering kami”</p>
            </div>
        </div>

        <?php
            $testimonials = [
                ['name' => 'Mamah Bihan', 'text' => 'Murah banget tapi rasanya enak parahh, porsinya juga banyak dan pengirimannya cepettt jadi gak nunggu lama 😍'],
                ['name' => 'Ibu Desi', 'text' => 'Juara pokoknyaa, makanannya datang masih hangat dan rasanya bikin nagih bangettt'],
                ['name' => 'Hani Sopah', 'text' => 'Bikin ketagihan sumpahh, bumbunya berasa banget dan pelayanannya juga ramahhh'],
                ['name' => 'Teh Siska', 'text' => 'Pertama kali coba langsung sukaa, pengirimannya tepat waktu dan makanannya fresh semuaa'],
                ['name' => 'Bunda Salma', 'text' => 'Harga ramah di kantong tapi kualitas makanannya mantappp, packingnya juga rapih banget'],
                ['name' => 'Bu Rina', 'text' => 'Tamu acara pada suka semuaa, bahkan banyak yang nanya cateringnya pesan dimana 😆'],
                ['name' => 'Kak Fira', 'text' => 'Porsinya banyak dan rasanya konsisten enakkk, cocok banget buat acara keluarga'],
                ['name' => 'Teh Anisa', 'text' => 'Pelayanannya cepet dan responsif, jadi pesen mendadak pun tetep aman 👍'],
                ['name' => 'Kang Aldi', 'text' => 'Makanannya bersih, datang masih hangat, dan rasanya kayak masakan rumahan yang bikin nyaman'],
                ['name' => 'Bu Rani', 'text' => 'Udah beberapa kali pesan dan gak pernah kecewa, pengiriman selalu ontimee'],
                ['name' => 'Ibu Neni', 'text' => 'Praktis banget tinggal terima beres, makanannya enak dan tampilannya juga rapihh'],
                ['name' => 'Mbak Salsa', 'text' => 'Enakkk bangettt pokoknya, sambelnya mantap dan pengirimannya juga super cepat 😍'],
            ];
        ?>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-50% - 1rem)); }
            }
            .animate-marquee {
                animation: marquee 60s linear infinite;
                display: flex;
                width: max-content;
            }
            .animate-marquee:hover {
                animation-play-state: paused;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3), inset 0 1px 0 0 rgba(255, 255, 255, 0.05);
            }
            .glass-card:hover {
                background: rgba(255, 255, 255, 0.06);
                border: 1px solid rgba(255, 255, 255, 0.15);
            }
        </style>

        <div class="relative z-10 w-full overflow-hidden pb-8 pt-4" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
            <div class="animate-marquee gap-8 px-8">
                <?php for($i = 0; $i < 2; $i++): ?>
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="glass-card p-8 rounded-3xl relative w-[350px] shrink-0 flex flex-col hover:-translate-y-2 transition-all duration-300">
                            <!-- Decorative Quote Mark -->
                            <div class="absolute top-6 right-6 text-orange-500/20 text-6xl font-serif font-black leading-none pointer-events-none">"</div>
                            
                            <div class="mb-5 relative z-10">
                                <h4 class="font-black text-xl text-white mb-2 tracking-wide"><?php echo e($t['name']); ?></h4>
                                <div class="flex text-orange-400 gap-1">
                                    <?php for($s = 0; $s < 5; $s++): ?>
                                    <svg class="w-5 h-5 fill-current filter drop-shadow-[0_0_8px_rgba(251,146,60,0.5)]" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="text-gray-300 text-base leading-relaxed flex-grow relative z-10 font-medium">"<?php echo e($t['text']); ?>"</p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Footer Stats -->
        <div class="relative z-10 mt-8 max-w-4xl mx-auto px-4">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-full py-4 px-6 flex flex-wrap justify-center items-center gap-y-4 gap-x-6 text-sm md:text-base font-bold text-gray-300 shadow-xl w-fit mx-auto">
                <div class="flex items-center gap-2">
                    <span class="text-xl">⭐</span> Rating 4.9/5
                </div>
                <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">🚚</span> Pengiriman Cepat
                </div>
                <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                <div class="flex items-center gap-2">
                    <span class="text-xl">🍱</span> Fresh Setiap Hari
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi & Kontak -->
    <section id="lokasi" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Kunjungi <span
                        class="text-orange-600">Kami</span></h2>
                <div class="w-24 h-1.5 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Lokasi strategis dan mudah dijangkau di pusat kota.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Informasi Kontak -->
                <div
                    class="bg-orange-50/50 p-8 sm:p-10 rounded-3xl border border-orange-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] h-full">
                    <h3 class="text-2xl font-black text-gray-900 mb-8">Informasi Kedai Uqy</h3>

                    <div class="space-y-8">
                        <!-- Alamat -->
                        <div class="flex items-start group">
                            <div
                                class="w-14 h-14 bg-white text-orange-600 rounded-2xl flex items-center justify-center shadow-sm shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Alamat Lengkap</h4>
                                <p class="text-gray-600 leading-relaxed text-sm">
                                    <span class="font-bold text-gray-800 text-base">Warung uqi</span><br>
                                    Jl. Pangeran Antasari No.10, RT.10/RW.4,<br>
                                    Purbawinangun, Kec. Plumbon, Kabupaten Cirebon,<br>
                                    Jawa Barat 45155, Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-start group">
                            <div
                                class="w-14 h-14 bg-white text-orange-600 rounded-2xl flex items-center justify-center shadow-sm shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">WhatsApp</h4>
                                <a href="https://wa.me/6289503095910" target="_blank"
                                    class="text-orange-600 font-medium hover:text-orange-700 hover:underline transition-colors">+62
                                    895-0309-5910</a>
                                <p class="text-gray-500 text-sm mt-1">Senin - Minggu (08:00 - 22:00)</p>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="flex items-start group">
                            <div
                                class="w-14 h-14 bg-white text-orange-600 rounded-2xl flex items-center justify-center shadow-sm shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Instagram</h4>
                                <a href="https://www.instagram.com/kedai.uqy?igsh=NmkwZzZxN2J3dDl0" target="_blank"
                                    class="text-orange-600 font-medium hover:text-orange-700 hover:underline transition-colors">@kedai.uqy</a>
                                <p class="text-gray-500 text-sm mt-1">Ikuti kami untuk promo menarik!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Embed Map -->
                <div
                    class="h-full min-h-[400px] rounded-3xl overflow-hidden shadow-xl border border-gray-100 relative group">
                    <div
                        class="absolute inset-0 bg-orange-600/10 pointer-events-none z-10 group-hover:bg-transparent transition-colors duration-500">
                    </div>
                    <!-- You can replace this src with your actual google maps embed url -->
                    <iframe
                        src="https://www.google.com/maps?q=Warung+uqi,+Jl.+Pangeran+Antasari+No.10,+RT.10/RW.4,+Purbawinangun,+Kec.+Plumbon,+Kabupaten+Cirebon,+Jawa+Barat+45155,+Indonesia&output=embed"
                        class="w-full h-full border-0 absolute inset-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kedai-uqy\resources\views/welcome.blade.php ENDPATH**/ ?>