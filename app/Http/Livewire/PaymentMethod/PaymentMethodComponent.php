<?php

namespace App\Http\Livewire\PaymentMethod;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\PaymentMethod;

class PaymentMethodComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $sortBy = "id";
    public $sortDirection = "asc";


    public $name, $edit_id, $e_name;

    public function Store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $data = new PaymentMethod();

        $data->name = $this->name;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Payment Method Created Successfuly']);
        }
        $this->emit('doSomething');
        $this->name = null;
    }

    public function getItem($id)
    {
        $data = PaymentMethod::find($id);

        $this->edit_id = $id;

        $this->e_name = $data->name;
    }

    public function Update()
    {
        $this->validate([
            'e_name' => 'required',
        ]);

        $data = PaymentMethod::find($this->edit_id);

        $data->name = $this->e_name;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Payment Method Updated Successfuly']);
        }
        $this->emit('doSomething');
        $this->e_name = null;
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == "asc") {
            $this->sortDirection = "desc";
        }
        else
        {
            $this->sortDirection = "asc";
        }

        return $this->sortBy = $field;
    }

    public function render()
    {
        $payment_methods = PaymentMethod::orderBy($this->sortBy,$this->sortDirection)->search(trim($this->search))->paginate(10);
        return view('livewire.payment-method.payment-method-component',compact('payment_methods'))->layout('livewire.base.base');
    }
}
