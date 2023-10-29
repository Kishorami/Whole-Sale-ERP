<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

use App\Models\Customer;

class AddCustomerComponent extends Component
{
    public $firm_name, $trade_license, $income_tax_no, $bin_no, $contact_person, $nid_no, $present_address, $permanent_address, $mobile_phone, $land_phone, $email, $credit_limit, $balance;

    public function Store()
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

        $data = new Customer();

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
        $data->balance = $this->balance;

        // dd($data);
        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'Customer Created Successfuly']);
        }

        $this->emit('doSomething');

        $this->firm_name = null;
        $this->trade_license = null;
        $this->income_tax_no = null;
        $this->bin_no = null;
        $this->contact_person = null;
        $this->nid_no = null;
        $this->present_address = null;
        $this->permanent_address = null;
        $this->mobile_phone = null;
        $this->land_phone = null;
        $this->email = null;
        $this->credit_limit = null;
        $this->balance = null;

    }
    
    public function render()
    {
        return view('livewire.customer.add-customer-component')->layout('livewire.base.base');
    }
}
