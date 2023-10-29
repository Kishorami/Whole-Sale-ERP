<?php

namespace App\Http\Livewire\Sell;

use Livewire\Component;
use Livewire\WithPagination;


use App\Models\SellToApprove;

class SellToApproveComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $sortBy = "id";
    public $sortDirection = "desc";

    public $delete_id;


    public function deleteID($id)
    {
        $this->delete_id = $id;
    }

    public function delete()
    {
        SellToApprove::find($this->delete_id)->delete();

        $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'Sales Deleted Successfully.']);
        $this->emit('doSomething');
        $this->delete_id = null;
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
        $sellToApprove = SellToApprove::orderBy($this->sortBy,$this->sortDirection)->with('customer')->with('invoiceBy')->search(trim($this->search))->paginate($this->paginate);

        // dd($sellToApprove);

        return view('livewire.sell.sell-to-approve-component',compact('sellToApprove'))->layout('livewire.base.base');
    }
}
