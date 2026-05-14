<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = Auth::id();
        
        $request->validate([
            'cart_ids' => 'required|array|min:1',
            'cart_ids.*' => 'exists:carts,id'
        ], [
            'cart_ids.required' => 'Pilih minimal satu menu untuk dicheckout.'
        ]);

        $carts = Cart::with('menu')
            ->where('user_id', $userId)
            ->whereIn('id', $request->cart_ids)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Item keranjang tidak ditemukan.');
        }

        try {
            // Gunakan database transaction agar aman
            $order = DB::transaction(function () use ($carts, $userId, $request) {
                // 1. Hitung total harga dari seluruh item di cart
                $total = $carts->sum(function($cart) {
                    return $cart->menu->price * $cart->quantity;
                });

                // 2. Simpan ke tabel orders
                $order = Order::create([
                    'user_id' => $userId,
                    'total' => $total,
                    'order_date' => now(),
                ]);

                // 3. Simpan setiap item ke tabel order_details
                foreach ($carts as $cart) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'menu_id' => $cart->menu_id,
                        'quantity' => $cart->quantity,
                    ]);
                }

                // 4. Kosongkan keranjang milik user tersebut (yang dipilih saja)
                Cart::where('user_id', $userId)->whereIn('id', $request->cart_ids)->delete();

                return $order;
            });

            // Generate WhatsApp Message
            $orderId = str_pad($order->id, 5, '0', STR_PAD_LEFT);
            $userName = Auth::user()->name;
            $totalFormatted = number_format($order->total, 0, ',', '.');
            
            $message = "Halo *Kedai Uqy*, saya mau konfirmasi pesanan:\n\n";
            $message .= "*Order ID:* #{$orderId}\n";
            $message .= "*Nama Pemesan:* {$userName}\n\n";
            $message .= "*Detail Pesanan:*\n";
            
            foreach ($carts as $cart) {
                $message .= "- {$cart->menu->name} ({$cart->quantity}x)\n";
            }
            
            $message .= "\n*Total Tagihan: Rp {$totalFormatted}*\n\n";
            $message .= "Mohon diproses ya, terima kasih!";

            // Nomor WhatsApp tujuan (gunakan nomor yang sama dengan di footer)
            $whatsappNumber = '6281234567890';
            $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNumber}&text=" . urlencode($message);

            // Set session success message in case they press back
            session()->flash('success', 'Checkout berhasil! Pesanan Anda telah tercatat.');

            // Redirect ke WhatsApp
            return redirect($whatsappUrl);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat checkout. Silakan coba lagi.');
        }
    }
}
