<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Login")]
class Login extends Component
{
    public $email;
    public $password;

    public function save(){
        $this->validate([
            "email" => "required|email|max:255|exists:users,email",
            "password" => "required|min:8|max:255"
        ]);
        if (!auth()->attempt(["email" => $this->email, "password" => $this->password])) {
            session()->flash("error", __('validation.invalid_email_password'));
            return;
        }

        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
