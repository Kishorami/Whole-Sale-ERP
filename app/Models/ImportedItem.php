<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_id','item_description','sku','unit_id','quantity','stock','sold','purchase_per_unit','cost_per_unit','unit_price','sell_price_low','sell_price_high',
    ];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }


    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('item_description','like',$term)
                    ->orWhere('sku','like',$term);
        });
    }
}
