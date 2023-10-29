<?php

namespace App\Http\Livewire\Settings\User;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $search = "";

    public $name, $email, $password, $user_type="";

    public $edit_id, $e_name, $e_email, $e_password, $e_user_type;


    public function Store()
    {
        $validatedData = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = new User();

        $data->name = $this->name;
        $data->email = $this->email;
        $data->password = Hash::make($this->password);
        $data->user_type = $this->user_type;
        $data->user_status = 1;

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'New User Created']);
        }
        
        $this->name = null;
        $this->email = null;
        $this->password = null;

        $this->emit('doSomething');
    }

    public function getItem($id)
    {
        $this->edit_id = $id;

        $data = User::find($this->edit_id);

        $this->e_name = $data->name;
        $this->e_email = $data->email;
        $this->e_user_type = $data->user_type;
    }

    public function Update()
    {

        if($this->e_password == "")
        {
            $this->e_password = null;
        }

        $validatedData = $this->validate([
            'e_name' => 'required|max:255',
            'e_email' => [
                'required',
                    Rule::unique('users', 'email')->ignore($this->edit_id)
                ],
        ]);

        if ($this->e_password != null) {
            $validatedData = $this->validate([
                'e_password' => 'min:8',
            ]);
        }

        $data = User::find($this->edit_id);

        $data->name = $this->e_name;
        $data->email = $this->e_email;
        $data->user_type = $this->e_user_type;

        if ($this->e_password != null) {
             $data->password = Hash::make($this->e_password);
        }

        // dd($data, $this->e_password);

        $done = $data->save();

        if ($done) {
            $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'User Updated']);
        }

        $this->edit_id = null;
        $this->e_name = null;
        $this->e_email = null;
        $this->e_password = null;
        $this->e_user_type = null;

        $this->emit('doSomething');
    }

    public function toggleActive($id)
    {
        $data = User::find($id);

        $temp = '';

        if ($data->user_status) {
            $data->user_status = 0;
            $temp = 'Deactivated';
        } else {
            $data->user_status = 1;
            $temp = 'Activated';
        }

        $done = $data->save();

        if ($done) {
            if ($temp === 'Activated') {
                $this->dispatchBrowserEvent('alert', 
                    ['type' => 'success',  'message' => 'User '.$data->name.' Activated Successfuly.']);
            } elseif ($temp === 'Deactivated') {
                $this->dispatchBrowserEvent('alert', 
                    ['type' => 'warning',  'message' => 'User '.$data->name.' Deactivated Successfuly.']);
            }
            
        }

        
    }

    public function render()
    {
        $users = User::search(trim($this->search))->paginate($this->paginate);
        return view('livewire.settings.user.user-component',compact('users'))->layout('livewire.base.base');
    }
}
