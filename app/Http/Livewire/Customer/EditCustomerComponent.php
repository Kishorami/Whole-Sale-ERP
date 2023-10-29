<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

use App\Models\Customer;

class EditCustomerComponent extends Component
{
    public $firm_name, $trade_license, $income_tax_no, $bin_no, $contact_person, $nid_no, $present_address, $permanent_address, $mobile_phone, $land_phone, $email, $credit_limit, $balance;
    public $edit_id;

    public function Update()
    {

        $this->validate([
            'firm_name' => 'required',
            'trade_license' => 'required',
            'income_tax_no' => 'required',
            'bin_no' => 'required',
            'contact_person' => 'required',
            'nid_no' => 'required',
            'mobile_phone' => 'required'
        ]);

        $data = Customer::find($this->edit_id);

        $data->firm_name = $this->firm_name;
        $data->trade_license = $this->trade_license;
        $data->income_tax_no = $this->income_tax_no;
        $data->bin_no = $this->bin_no;
        $data->contact_person = $this->contact_person;
        $data->nid_no = $this->nid_no;
        $data->present_address = $this->present_address;
        $data->permanent_address = $this->permanent_address;
        $data->mobile_phone = $this->mobile_phone;
        $data->land_phone = $this->land_phone;
        $data->email = $this->email;
        $data->credit_limit = $this->credit_limit;
        // $data->balance = $this->balance;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Customer Updated Successfuly']);
        }

    }


    public function mount($id)
    {
        $this->edit_id = $id;

        $data = Customer::find($id);

        $this->firm_name = $data->firm_name;
        $this->trade_license = $data->trade_license;
        $this->income_tax_no = $data->income_tax_no;
        $this->bin_no = $data->bin_no;
        $this->contact_person = $data->contact_person;
        $this->nid_no = $data->nid_no;
        $this->present_address = $data->present_address;
        $this->permanent_address = $data->permanent_address;
        $this->mobile_phone = $data->mobile_phone;
        $this->land_phone = $data->land_phone;
        $this->email = $data->email;
        $this->credit_limit = $data->credit_limit;
        $this->balance = $data->balance;
    }
    public function render()
    {
        return view('livewire.customer.edit-customer-component')->layout('livewire.base.base');
    }
}
