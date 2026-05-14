<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Memastikan Menu Pilihan Terbaik selalu 3 ikan favorit ini
    $favoriteMenus = ['Ikan Garang Asem', 'Ikan Kakap Merah', 'Ikan Nila Cobek'];
    $menus = \App\Models\Menu::whereIn('name', $favoriteMenus)->get();
    
    // Fallback jika belum ada data menu tersebut
    if ($menus->count() == 0) {
        $menus = \App\Models\Menu::latest()->take(3)->get();
    }
    
    return view('welcome', compact('menus'));
});

Route::get('/menu', [\App\Http\Controllers\MenuController::class, 'index'])->name('menu');


Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    $orders = $user->orders()->with('orderDetails.menu')->latest()->get();
    $carts = \App\Models\Cart::with('menu')->where('user_id', $user->id)->latest()->get();
    return view('dashboard', compact('orders', 'user', 'carts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    
    // Checkout Route
    Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    
    // Menus
    Route::get('/menus', [\App\Http\Controllers\AdminController::class, 'menus'])->name('menus');
    Route::get('/menus/create', [\App\Http\Controllers\AdminController::class, 'createMenu'])->name('menus.create');
    Route::post('/menus', [\App\Http\Controllers\AdminController::class, 'storeMenu'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [\App\Http\Controllers\AdminController::class, 'editMenu'])->name('menus.edit');
    Route::put('/menus/{menu}', [\App\Http\Controllers\AdminController::class, 'updateMenu'])->name('menus.update');
    Route::delete('/menus/{menu}', [\App\Http\Controllers\AdminController::class, 'destroyMenu'])->name('menus.destroy');

    // Orders
    Route::get('/orders', [\App\Http\Controllers\AdminController::class, 'orders'])->name('orders');
    Route::put('/orders/{order}/status', [\App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    // Laporan
    Route::get('/laporan', [\App\Http\Controllers\AdminController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/print', [\App\Http\Controllers\AdminController::class, 'printLaporan'])->name('laporan.print');
});

require __DIR__.'/auth.php';
