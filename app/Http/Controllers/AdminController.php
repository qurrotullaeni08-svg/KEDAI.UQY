<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        $totalMenus = Menu::count();
        
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalMenus', 'recentOrders'));
    }

    // List Menu (Manage)
    public function menus()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    // Form Tambah Menu
    public function createMenu()
    {
        return view('admin.menus.create');
    }

    // Simpan Menu Baru
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Form Edit Menu
    public function editMenu(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    // Update Menu
    public function updateMenu(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diupdate!');
    }

    // Hapus Menu
    public function destroyMenu(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus!');
    }

    // List Pesanan
    public function orders()
    {
        $orders = Order::with(['user', 'orderDetails.menu'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Konfirmasi,Diproses,Dikirim,Selesai'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Halaman Laporan
    public function laporan(Request $request)
    {
        $query = Order::with('user')->where('status', 'Selesai')->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('order_date', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $orders = $query->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total');
        $completedOrders = $orders->count();

        return view('admin.laporan.index', compact('orders', 'totalOrders', 'totalRevenue', 'completedOrders'));
    }

    // Print Laporan
    public function printLaporan(Request $request)
    {
        $query = Order::with('user')->where('status', 'Selesai')->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('order_date', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $orders = $query->get();
        $totalRevenue = $orders->sum('total');
        $completedOrders = $orders->count();

        return view('admin.laporan.print', compact('orders', 'totalRevenue', 'completedOrders', 'request'));
    }
}
