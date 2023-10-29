<?php

namespace App\Http\Livewire\Sell;

use Livewire\Component;

use App\Models\ImportedItem;
use App\Models\Customer;
use App\Models\SellToApprove;
use DB;

class MakeSellComponent extends Component
{
    public $search = "";
    public $barcode;


    public $product_list = [

        ];
    public $sub_total=0;
    public $grand_total=0;

    public $customer_id="";

    public function addToList($id)
    {

        if ($this->customer_id === "") {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Select a Customer First.']);
            return;
        }

        $get_product =self::getProduct($id);

        if (!$get_product) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Product Not Found']);
            return;
        }

        $indexkey =self::existProduct($get_product->id);

        if ($get_product->stock == 0) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => $get_product->name .' Out of Stock.']);
            return;
        }

        if ($indexkey !=-1) {
            
            if ($get_product->stock==$this->product_list[$indexkey]['quantity']) {
                $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Higher Than '. $get_product->name .' Stock.']);
                return;
            }
            $this->product_list[$indexkey]['quantity']++;

            $this->product_list = array_values($this->product_list);

            $this->grand_total = self::Total();
        }else{
            $this->product_list[] = [
                'id'=>$get_product->id,
                'name'=>$get_product->item_description,
                'sku'=>$get_product->sku,
                'price'=>$get_product->sell_price_high,
                'quantity'=>'1',
                'stock'=>$get_product->stock,
            ];
            $this->grand_total = self::Total();
        }
    }

    public function remove($product_id)
    {
        unset($this->product_list[$product_id]);

        $this->product_list = array_values($this->product_list);
        $this->grand_total = self::Total();
    }

    public function updateQty($product_id,$new_qty)
    {
        if ($new_qty<1) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Must be 1 or Greater']);
            return;
        }

        $get_product =self:: getProduct($this->product_list[$product_id]['id']);

        if ($this->product_list[$product_id]['stock']<$new_qty) {

            $this->product_list = array_values($this->product_list);

            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Quantity Higher Than '. $this->product_list[$product_id]['name'] .' Stock.']);
            return;
        }else{
            $this->product_list[$product_id]['quantity'] = $new_qty;

            $this->product_list = array_values($this->product_list);

            $this->grand_total = self::Total();
        }
    }

    public function updatePrice($product_id,$new_price)
    {
        $this->product_list[$product_id]['price'] = $new_price;

        $this->product_list = array_values($this->product_list);

        $this->grand_total = self::Total();
    }

    public function getProduct($id)
    {
        $productInfo =  ImportedItem::where('stock','>',0)->where('id',$id)->first();
        return $productInfo;
    }

    public function existProduct($id)
    {
        $indexkey = -1;
        foreach ($this->product_list as $key=>$value) {
            if($value['id'] == $id){
                $indexkey = $key;
            }
        }

        return $indexkey;
    }

    public function Total()
    {
        $total=0;
        foreach ($this->product_list as $key) {
            $total=$total + $key['price']*$key['quantity'];
        }
        $this->sub_total = $total;
        return $total;
    }


    public function addWithBarcode($sku)
    {
        $item = ImportedItem::where('stock','>',0)->where('sku',$sku)->first();

        if ($item) {
            $this->barcode = null;
            $this->search = $sku;
            self::addToList($item->id);
        }else{
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'error',  'message' => 'Given Code is Wrong.']);
            $this->barcode = null;
            return;
        }
        
    }

    public function Store()
    {
        $this->validate([
            'customer_id' => 'required',
        ]);

        if ($this->grand_total <= 0) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'error',  'message' => 'Invoice is empty. Add Some Product.']);
            return;
        }

        $data = new SellToApprove();

        // $lastInvoiceID = $data->orderBy('id', 'DESC')->pluck('id')->first();
        $databaseName = DB::connection()->getDatabaseName();

        $lastInvoiceID = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$databaseName' AND TABLE_NAME = 'sell_to_approves'");

        $newInvoiceID = $lastInvoiceID[0]->AUTO_INCREMENT;

        

        $bill_no = str_pad($newInvoiceID, 6, '0', STR_PAD_LEFT); //------Bill no ---------------

        $data->products = json_encode($this->product_list);
        $data->bill_no = $bill_no;
        $data->customer_id = $this->customer_id;
        $data->invoice_by = auth()->user()->id;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Sale Successfully Created for Approval.']);
        }

        $this->emit('reset_customer');
        $this->product_list = [];
        $this->customer_id = "";
        $this->sub_total = null;
        $this->grand_total = null;
    }

    public function render()
    {
        $products = collect();

        if ($this->search != "") {
            $products = ImportedItem::where('stock','>',0)->with('import')->search(trim($this->search))->get()->groupBy('sku');
        }
        $customers = Customer::all();

        $selected_customer = null;

        if ($this->customer_id) {
            $selected_customer = Customer::find($this->customer_id);
        }
        return view('livewire.sell.make-sell-component',compact('products','customers','selected_customer'))->layout('livewire.base.base');
    }
}
