<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Lihat Cart
    public function index()
    {
        // Ambil data keranjang milik user yang sedang login beserta data menu-nya
        $carts = Cart::with('menu')->where('user_id', Auth::id())->latest()->get();
        
        // Hitung total harga
        $total = $carts->sum(function($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        return view('cart', compact('carts', 'total'));
    }

    // Tambah ke Cart
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
        ]);

        // Cek apakah item sudah ada di keranjang user
        $cart = Cart::where('user_id', Auth::id())
                    ->where('menu_id', $request->menu_id)
                    ->first();

        if ($cart) {
            // Jika ada, tambah quantity
            $cart->increment('quantity');
        } else {
            // Jika belum, buat item baru
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $request->menu_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Update jumlah item di cart
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Pastikan hanya bisa update keranjang miliknya sendiri
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->update([
            'quantity' => $request->quantity
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Jumlah pesanan berhasil diperbarui!');
    }

    // Hapus item dari cart
    public function destroy($id)
    {
        // Pastikan hanya bisa hapus keranjang miliknya sendiri
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}
