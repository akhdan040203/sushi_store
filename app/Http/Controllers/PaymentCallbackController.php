<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notification = new Notification();

            $rawOrderNumber = $notification->order_id;
            // Clean suffix if present (e.g., ORD20240101ABCD-123456789)
            $orderNumber = explode('-', $rawOrderNumber)[0];
            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                return response()->json([
                    'meta' => [
                        'code' => 404,
                        'message' => 'Order not found'
                    ]
                ], 404);
            }

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->update(['payment_status' => 'challenged']);
                } else {
                    $order->update(['payment_status' => 'paid', 'status' => 'processing']);
                }
            } else if ($transactionStatus == 'settlement') {
                $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            } else if ($transactionStatus == 'pending') {
                $order->update(['payment_status' => 'pending']);
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update(['payment_status' => 'failed', 'status' => 'cancelled']);
                
                // Kembalikan stok jika gagal dan stok pernah dikurangi
                if ($order->stock_decremented) {
                    foreach ($order->items as $item) {
                        Product::find($item->product_id)->increment('stock', $item->quantity);
                    }
                    $order->update(['stock_decremented' => false]);
                }
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
