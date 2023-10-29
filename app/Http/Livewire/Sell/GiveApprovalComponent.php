<?php

namespace App\Http\Livewire\Sell;

use Livewire\Component;

use App\Models\ImportedItem;
use App\Models\Customer;
use App\Models\SellToApprove;
use App\Models\ApprovedSell;
use App\Models\Ledger;
use App\Models\SoldItem;
use App\Models\User;
use App\Models\PaymentMethod;
use DB;
use Carbon\Carbon;
class GiveApprovalComponent extends Component
{
    public $search = "";
    public $barcode;


    public $product_list = [

        ];
    public $sub_total=0;
    public $grand_total=0;
    public $discount_percent = 0;
    public $sell_id, $bill_no, $invoice_by, $checked_by, $paid_amount=0, $note;
    public $customer_id="";
    public $payment_method_id="";
    public $has_credit_limit=false;

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

        $discount = ($total / 100)*$this->discount_percent;
        $grand_total = $total-$discount;
        return $grand_total;
    }

    public function addDiscount($discount)
    {
        if ($discount<0 || $discount == null) {
            $discount = 0;
        }elseif($discount>100){
            $discount = 100;
        }

        $this->discount_percent = $discount;
        $this->grand_total = self::Total();
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

        if (!$this->has_credit_limit ) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'error',  'message' => 'Can not Approve. Balance will be higher than Credit Limit.']);
            return;
        }

        $oldSale = SellToApprove::find($this->sell_id);

        $content = json_decode(json_encode($this->product_list));
        // Approved sell table Insert---------------------------------------------------        
        $old_sale = SellToApprove::find($this->sell_id);

        $sell = new ApprovedSell();

        $sell->products = json_encode($this->product_list);
        $sell->bill_no = $this->bill_no;
        $sell->customer_id = $this->customer_id;
        $sell->invoice_by = $oldSale->invoice_by;
        $sell->checked_by = $this->checked_by;
        $sell->approved_by = auth()->user()->id;
        $sell->sub_total = $this->sub_total;
        $sell->discount_percent = $this->discount_percent;
        $sell->grand_total = $this->grand_total;
        $sell->payment_method_id = $this->payment_method_id;
        $sell->note = $this->note;

        $sell->save();

        // Approved sell table Insert---------------------------------------------------

        //Sold Item insert----------------------------------------------
        foreach ($content as $key => $value) {

            $temp_item = ImportedItem::find($value->id);
            $temp_profit = ($value->price - $temp_item->unit_price) * $value->quantity;

            $sold_item = new SoldItem();

            $sold_item->approved_sell_id = $sell->id;
            $sold_item->imported_item_id = $value->id;
            $sold_item->quantity = $value->quantity;
            $sold_item->sell_price = $value->price;
            $sold_item->profit = $temp_profit;

            $sold_item->save();
        }
        //Sold Item insert----------------------------------------------

        //Stock Adjust----------------------------------------------
        foreach ($content as $key => $value) {
            $temp_quantity = $value->quantity;

            $temp_product = ImportedItem::find($value->id);

            $temp_product->stock = $temp_product->stock - $temp_quantity;
            $temp_product->sold = $temp_product->sold + $temp_quantity;

            $temp_product->save();
        }
        //Stock Adjust----------------------------------------------

        //Ledger Table insert-------------------------------------
        $ledger = new Ledger();

        $ledger_info = ledger::where('customer_id',$this->customer_id)->orderBy('id', 'desc')->first();

        $ledger->customer_id = $this->customer_id;
        $ledger->date = Carbon::now();
        $ledger->particulars = 'Bill';
        $ledger->bill_code = $this->bill_no;
        $ledger->debit = $this->paid_amount;
        $ledger->credit = $this->grand_total;

        if($ledger_info){
            $ledger->balance = $ledger_info->balance + ($this->grand_total - $this->paid_amount);
        }else{
            $ledger->balance = 0 + ($this->grand_total - $this->paid_amount);
        }
        $ledger->payment_method_id = $this->payment_method_id;
        $ledger->note = $this->note;

        $ledger->save();
        //Ledger Table insert-------------------------------------

        //Customer Table Update-------------------------------------
        $customer_info = Customer::find($this->customer_id);

        $customer_info->balance = $customer_info->balance + ($this->grand_total - $this->paid_amount);
        $customer_info->point = $customer_info->point + (($this->grand_total/100) * 0.5);
        $customer_info->save();
        //Customer Table Update-------------------------------------

        
        $oldSale->delete();

        session()->flash('message','Sell Approved Successfully.');
        return redirect()->route('approved_sells');
    }


    public function checkCreditLimit()
    {
        $customer_info = Customer::find($this->customer_id);

        $temp_limit = $customer_info->balance + ($this->grand_total - $this->paid_amount);

        if ($customer_info->credit_limit >= $temp_limit) {
            $this->has_credit_limit = true;
        } else {
            $this->has_credit_limit = false;
        }
        
    }

    public function mount($id)
    {
        $this->sell_id = $id;

        $data = SellToApprove::where('id',$id)->with('customer','invoiceBy')->first();

        $this->bill_no = $data->bill_no;

        $this->invoice_by = $data->invoiceBy->name;
        $this->customer_id = $data->customer_id;

        $products = json_decode($data->products);

        foreach ($products as $key=>$value) {
            $this->product_list[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'sku'=>$value->sku,
                'price'=>$value->price,
                'quantity'=>$value->quantity,
                'stock'=>$value->stock,
            ];
        }
        $this->grand_total = self::Total();


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

        $users = User::select('id','name')->get();
        $payment_methods = PaymentMethod::all();
        
        self::checkCreditLimit();
        $limit = $this->has_credit_limit;

        return view('livewire.sell.give-approval-component',compact('products','customers','selected_customer','users','payment_methods','limit'))->layout('livewire.base.base');
    }
}
