<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class AuthUser extends Component
{
    public  $Login=true;
    public function render()
    {
        return view('livewire.auth.auth-user');
    }

    public function Loginstute()
    {
        //    dd($this->Login);
        if ($this->Login) {
        $this->Login=false;
       } else {
        $this->Login=true;
       }
       
    }

    
}
