<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_code', 'region', 'note', 'import_date',
    ];

    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term)
        {
            $query->where('import_code','like',$term)
                    ->orWhere('region','like',$term)
                    ->orWhere('note','like',$term)
                    ->orWhere('import_date','like',$term);
        });
    }
}
