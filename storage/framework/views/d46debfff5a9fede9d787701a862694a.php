<?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
<aside class="flex-shrink-0 w-64 flex flex-col border-r border-gray-800 transition-all duration-300 bg-gray-900 text-white z-30 fixed md:relative h-full" :class="{'hidden': !sidebarOpen, 'block': sidebarOpen, 'md:block': true}">
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <div class="px-4 py-2 text-xs font-black text-gray-500 uppercase tracking-wider mb-2">Admin Panel</div>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-4 py-3 rounded-xl <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white shadow-md' : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?> transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.menus')); ?>" class="flex items-center px-4 py-3 rounded-xl <?php echo e(request()->routeIs('admin.menus*') ? 'bg-orange-600 text-white shadow-md' : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?> transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            Kelola Menu
        </a>
        <a href="<?php echo e(route('admin.orders')); ?>" class="flex items-center px-4 py-3 rounded-xl <?php echo e(request()->routeIs('admin.orders*') ? 'bg-orange-600 text-white shadow-md' : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?> transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            Pesanan Masuk
        </a>
        <a href="<?php echo e(route('admin.laporan')); ?>" class="flex items-center px-4 py-3 rounded-xl <?php echo e(request()->routeIs('admin.laporan*') ? 'bg-orange-600 text-white shadow-md' : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?> transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Laporan
        </a>
    </nav>
</aside>
<!-- Mobile Sidebar Overlay -->
<div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-gray-900/50 z-20 md:hidden"></div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kedai-uqy\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>