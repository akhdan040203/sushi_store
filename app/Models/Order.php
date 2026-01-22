<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'order_number',
        'order_type',
        'table_number',
        'status',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'payment_method',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return $prefix . $date . $random;
    }

    // Status labels in Indonesian
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Sedang Dikirim',
            'delivered' => 'Terkirim',
            'cancelled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    // Payment status labels
    public function getPaymentStatusLabelAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Pembayaran Gagal',
            default => $this->payment_status,
        };
    }
}
