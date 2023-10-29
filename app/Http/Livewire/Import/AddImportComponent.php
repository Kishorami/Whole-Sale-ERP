<?php

namespace App\Http\Livewire\Import;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Import;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class AddImportComponent extends Component
{
    use WithFileUploads;

    public $import_code, $region, $note, $import_date, $product_input_type = "";

    public $product_list_excel;


    public function Store($value='')
    {
        $data = new Import();

        $data->import_code = $this->import_code;
        $data->region = $this->region;
        $data->note = $this->note;
        $data->import_date = $this->import_date;

        $done = $data->save();

        if ($done) {


            if ($this->product_input_type === 'from_excel') {
                $import = Excel::import(new ProductsImport($data->id), $this->product_list_excel);
            }

            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Import Created Successfuly']);
        }

        $this->import_code = null;
        $this->region = null;
        $this->note = null;
        $this->import_date = null;
        $this->product_input_type = "";
        $this->product_list_excel = null;
    }

    public function render()
    {
        return view('livewire.import.add-import-component')->layout('livewire.base.base');
    }
}
