<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firm_name', 'trade_license', 'income_tax_no', 'bin_no', 'contact_person', 'nid_no', 'present_address', 'permanent_address', 'mobile_phone', 'land_phone', 'email', 'credit_limit', 'balance','point',
    ];

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('firm_name','like',$term)
                    ->orWhere('trade_license','like',$term)
                    ->orWhere('income_tax_no','like',$term)
                    ->orWhere('bin_no','like',$term)
                    ->orWhere('contact_person','like',$term)
                    ->orWhere('mobile_phone','like',$term)
                    ->orWhere('land_phone','like',$term)
                    ->orWhere('email','like',$term);
        });
    }
}
