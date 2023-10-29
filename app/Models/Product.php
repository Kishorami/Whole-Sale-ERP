<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_description', 'sku', 'unit_id', 'stock', 'sold', 'unit_price', 'sell_price_low', 'sell_price_high',
    ];
}
