<?php

namespace App\Http\Livewire\Import;

use Livewire\Component;

use App\Models\ImportedItem;
use App\Models\Unit;
use App\Models\Product;
use Illuminate\Validation\Rule;

class ImportedProductComponent extends Component
{

    public $import_id;

    public $item_description, $sku, $unit_id="", $quantity, $stock, $sold, $purchase_per_unit, $cost_per_unit, $unit_price, $sell_price_low, $sell_price_high;

    public function mount($id)
    {
        $this->import_id = $id;
    }


    public function Store()
    {


        $this->validate([
            'sku'=>[
                'required',
                // Rule::unique('products', 'sku')->ignore($this->product_id)
                Rule::unique('imported_items', 'sku')->where(function ($query) { 
                                                    $query->where('sku', $this->sku)
                                                            ->where('import_id', $this->import_id); 
                                                })
                ],
        ]);


        $data = new ImportedItem();

        $data->import_id = $this->import_id;
        $data->item_description = $this->item_description;
        $data->sku = $this->sku;
        $data->unit_id = $this->unit_id;
        $data->quantity = $this->quantity;
        $data->stock = $this->quantity;
        $data->sold = 0;
        $data->purchase_per_unit = $this->purchase_per_unit;
        $data->cost_per_unit = $this->cost_per_unit;
        $data->unit_price = $this->purchase_per_unit + $this->cost_per_unit;
        $data->sell_price_low = $this->sell_price_low;
        $data->sell_price_high = $this->sell_price_high;

        $done = $data->save();

        if ($done) {            

            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Product Added Successfuly']);
            
            $this->emit('doSomething');
        }

        $this->item_description = null;
        $this->sku = null;
        $this->unit_id="";
        $this->quantity = null;
        $this->stock = null;
        $this->sold = null;
        $this->purchase_per_unit = null;
        $this->cost_per_unit = null;
        $this->unit_price = null;
        $this->sell_price_low = null;
        $this->sell_price_high = null;

    }


    public function render()
    {
        $importedItems = ImportedItem::where('import_id',$this->import_id)->with('import','unit')->get();
        $units = Unit::all();
        return view('livewire.import.imported-product-component',compact('importedItems','units'))->layout('livewire.base.base');
    }
}
