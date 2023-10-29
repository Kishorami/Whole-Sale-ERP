<?php

namespace App\Http\Livewire\Sell;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ApprovedSell;

class ApprovedSellComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $sortBy = "id";
    public $sortDirection = "desc";

    public $delete_id;

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
        $approved_sells = ApprovedSell::orderBy($this->sortBy,$this->sortDirection)->with('customer','invoiceBy','checkedBy','approvedBy','paymentMethod')->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.sell.approved-sell-component',compact('approved_sells'))->layout('livewire.base.base');
    }
}
