<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpOrder extends Model
{
    use HasFactory;

    protected $table = 'vp_orders';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'total_price',
        'total_products',
        'placed_order_date',
    ];

    public function getTotalPriceAttribute($value)
    {
        return floatval($value);
    }
}
