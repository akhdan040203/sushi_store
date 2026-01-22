<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'image',
        'stock',
        'rating',
        'rating_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Get the effective price (discount price if available, otherwise regular price)
    public function getEffectivePriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    // Check if product has discount
    public function getHasDiscountAttribute()
    {
        return $this->discount_price !== null && $this->discount_price < $this->price;
    }

    // Get discount percentage
    public function getDiscountPercentageAttribute()
    {
        if (!$this->has_discount) {
            return 0;
        }
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    // Check if product is in stock
    public function getInStockAttribute()
    {
        return $this->stock > 0;
    }
}
