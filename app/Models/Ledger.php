<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected   $fillable = [
                'customer_id', 'date', 'particulars', 'bill_code', 'debit', 'credit', 'balance', 'payment_method_id', 'note',
                ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('particulars','like',$term);
        });
    }
}
