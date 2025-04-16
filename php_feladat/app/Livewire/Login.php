<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;


    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8'
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/');
        } else {
            session()->flash('error', 'Helytelen email vagy jelszó!');
        }
    }


    public function render()
    {
        return view('livewire.login');
    }
}
