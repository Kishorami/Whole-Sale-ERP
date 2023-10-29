<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;

    protected $fillable = [
            'approved_sell_id', 'imported_item_id', 'quantity', 'sell_price', 'profit',
            ];

    public function product()
    {
        return $this->belongsTo(ImportedItem::class, 'imported_item_id')->with('unit');
    }
}
