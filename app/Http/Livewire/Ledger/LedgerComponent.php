<?php

namespace App\Http\Livewire\Ledger;

use Livewire\Component;
use Livewire\WithPagination;


use App\Models\Ledger;
use App\Models\Customer;
use App\Models\PaymentMethod;

class LedgerComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $sortBy = "id";
    public $sortDirection = "asc";

    public $customer_id;

    public $date, $particulars, $debit, $payment_method_id="", $note;

    public $edit_id, $e_particulars, $e_note, $e_payment_method_id;

    public function Store()
    {

        $this->validate([
            'date' => 'required',
            'particulars' => 'required',
            'debit' => 'required',
            'payment_method_id' => 'required',
        ]);

        $temp_customer = Customer::find($this->customer_id);

        $ledger = new Ledger();

        $ledger->customer_id = $this->customer_id;
        $ledger->date = $this->date;
        $ledger->particulars = $this->particulars;
        $ledger->debit = $this->debit;
        $ledger->balance = $temp_customer->balance - $this->debit;
        $ledger->payment_method_id = $this->payment_method_id;
        $ledger->note = $this->note;

        $temp_customer->balance = $temp_customer->balance - $this->debit;

        $ledger->save();
        $temp_customer->save();

        $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Debit Added Successfuly']);
        $this->emit('doSomething');
        $this->emit('reset_payment_method');

        $this->date = null;
        $this->particulars = null;
        $this->debit = null;
        $this->payment_method_id = "";
        $this->note = null;
    }    

    public function getItem($id)
    {
        $this->edit_id = $id;

        $data = Ledger::find($id);

        $this->e_particulars = $data->particulars;
        $this->e_payment_method_id = $data->payment_method_id;
        $this->e_note = $data->note;
        $this->emit('set_payment_method');
    }

    public function Update()
    {
        $data = Ledger::find($this->edit_id);

        $data->particulars = $this->e_particulars;
        $data->note = $this->e_note;

        $data->save();

        $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Debit Update Successfully']);
        $this->emit('doSomething');

        $this->e_particulars = null;
        $this->e_note = null;
        $this->e_payment_method_id = null;
        $this->edit_id = null;

    }

    public function mount($id)
    {
        $this->customer_id = $id;
    }

    public function render()
    {
        $records = Ledger::orderBy($this->sortBy,$this->sortDirection)->where('customer_id',$this->customer_id)->with('paymentMethod')->search(trim($this->search))->paginate($this->paginate);

        $customer_info = Customer::find($this->customer_id);
        $payment_methods = PaymentMethod::all();
        return view('livewire.ledger.ledger-component',compact('records','customer_info','payment_methods'))->layout('livewire.base.base');
    }
}
