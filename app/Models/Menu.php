<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'category',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
