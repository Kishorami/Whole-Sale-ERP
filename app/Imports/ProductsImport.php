<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\ImportedItem;
use App\Models\Product;

class ProductsImport implements ToCollection
{
    public $import_id;

    public function __construct($import_id)
    {
        $this->import_id = $import_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            ImportedItem::create([
                'import_id' => $this->import_id,
                'item_description' => $row[0],
                'sku' => $row[1],
                'unit_id' => $row[2],
                'quantity' => $row[3],
                'stock' => $row[3],
                'purchase_per_unit' => $row[4],
                'cost_per_unit' => $row[5],
                'unit_price' => $row[4] + $row[5],
                'sell_price_low' => $row[6],
                'sell_price_high' => $row[7],
            ]);

        }
    }
}
