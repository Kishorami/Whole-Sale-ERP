<?php

namespace App\Http\Livewire\Import;

use Livewire\Component;
use Livewire\WithPagination;


use App\Models\Import;
use Illuminate\Validation\Rule;

class ImportComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";
    public $sortBy = "id";
    public $sortDirection = "asc";


    public $edit_id, $import_code, $region, $note, $import_date;


    public function getItem($id)
    {
        $this->edit_id = $id;

        $data = Import::find($id);

        $this->import_code = $data->import_code;
        $this->region = $data->region;
        $this->note = $data->note;
        $this->import_date = $data->import_date;

    }

    public function Update()
    {
        $this->validate([
            'region' => 'required',
            'note' => 'required',
            'import_date' => 'required',
            'import_code'=>[
                'required',
                Rule::unique('imports', 'import_code')->ignore($this->edit_id)
                ],
        ]);


        $data = Import::find($this->edit_id);

        $data->import_code = $this->import_code;
        $data->region = $this->region;
        $data->note = $this->note;
        $data->import_date = $this->import_date;

        $done = $data->save();

        if ($done) {

            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Import Information Updated Successfuly']);

            $this->emit('doSomething');
        }
        $this->import_code = null;
        $this->region = null;
        $this->note = null;
        $this->import_date = null;
        $this->edit_id = null;

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
        $allImports = Import::orderBy($this->sortBy,$this->sortDirection)->search(trim($this->search))->paginate($this->paginate);
        return view('livewire.import.import-component',compact('allImports'))->layout('livewire.base.base');
    }
}
