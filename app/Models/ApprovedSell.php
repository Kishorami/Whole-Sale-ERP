<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedSell extends Model
{
    use HasFactory;

    protected $fillable = [
            'products', 'bill_no', 'customer_id', 'invoice_by', 'checked_by', 'approved_by', 'sub_total', 'discount_percent', 'grand_total',
            ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceBy()
    {
        return $this->belongsTo(User::class,'invoice_by');
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function soldItem()
    {
        return $this->hasMany(SoldItem::class)->with('product');
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
                    })
                    ->orWhereHas('checkedBy', function($query) use ($term){
                        $query->where('name','like',$term);
                    })
                    ->orWhereHas('approvedBy', function($query) use ($term){
                        $query->where('name','like',$term);
                    })
                    ->orWhereHas('paymentMethod', function($query) use ($term){
                        $query->where('name','like',$term);
                    });
        });
    }
}
