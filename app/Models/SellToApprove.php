<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellToApprove extends Model
{
    use HasFactory;

    protected $fillable = [
            'products', 'bill_no', 'customer_id', 'invoice_by',
        ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function invoiceBy(){
        return $this->belongsTo(User::class,'invoice_by');
    }

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('bill_no','like',$term)
                    ->orWhere('created_at','like',$term)
                    ->orWhereHas('customer', function($query) use ($term){
                        $query->where('firm_name','like',$term);
                    })
                    ->orWhereHas('invoiceBy', function($query) use ($term){
                        $query->where('name','like',$term);
                    });
        });
    }
}
