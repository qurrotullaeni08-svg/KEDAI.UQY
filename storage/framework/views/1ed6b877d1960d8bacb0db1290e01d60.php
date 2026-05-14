<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Kedai Uqy')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
            <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php else: ?>
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <?php endif; ?>
        <style>body { font-family: 'Inter', sans-serif; }</style>
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-orange-500 selection:text-white bg-gray-950">
        <div class="min-h-screen flex flex-col md:flex-row">
            
            <!-- Left Side: Image & Branding (Hidden on mobile) -->
            <div class="hidden md:flex md:w-1/2 lg:w-3/5 relative bg-black overflow-hidden items-center justify-center">
                <img src="<?php echo e(asset('images/sundanese_food_hero.png')); ?>" alt="Kedai Uqy Background" class="absolute inset-0 w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/60 to-transparent"></div>
                <div class="absolute inset-0 bg-orange-600/10"></div>
                
                <div class="relative z-10 px-12 text-center max-w-2xl">
                    <img src="<?php echo e(asset('images/kedai.uqy.jpeg')); ?>" alt="Logo" class="w-24 h-24 mx-auto rounded-2xl shadow-2xl mb-8 border-2 border-orange-500/20">
                    <h1 class="text-4xl lg:text-5xl font-black text-white tracking-tight mb-4">Cita Rasa Autentik,<br>Kini Dalam Genggaman.</h1>
                    <p class="text-lg text-gray-300 leading-relaxed">Masuk ke akun Anda untuk pengalaman pemesanan yang lebih cepat, melacak pesanan, dan mendapatkan penawaran spesial dari Kedai Uqy.</p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 md:px-12 lg:px-24 bg-[#1a1512] min-h-screen relative shadow-2xl">
                <!-- Mobile Logo -->
                <div class="md:hidden mb-8 text-center">
                    <img src="<?php echo e(asset('images/kedai.uqy.jpeg')); ?>" alt="Logo" class="w-16 h-16 mx-auto rounded-xl shadow-lg mb-4 border border-orange-500/20">
                    <h2 class="text-2xl font-black text-white tracking-tight">Kedai <span class="text-orange-500">Uqy</span></h2>
                </div>

                <div class="w-full max-w-md bg-gray-900/40 backdrop-blur-md p-8 sm:p-10 rounded-3xl border border-orange-900/30 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <?php echo e($slot); ?>

                </div>
                
                <!-- Back to Home -->
                <a href="/" class="absolute top-8 right-8 text-gray-400 hover:text-orange-500 transition-colors flex items-center gap-2 text-sm font-medium bg-white/5 px-4 py-2 rounded-full border border-white/10 hover:border-orange-500/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\kedai-uqy\resources\views/layouts/guest.blade.php ENDPATH**/ ?>