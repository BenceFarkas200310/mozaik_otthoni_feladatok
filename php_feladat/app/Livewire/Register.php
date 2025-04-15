<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone_number;
    public $address;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
    ];

    public function register()
    {
        $this->validate();
        
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone_number' => $this->phone_number,
            'address' => $this->address,
        ]);

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.register');
    }
}