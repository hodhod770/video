<?php

namespace App\Livewire;

use Livewire\Component;
use Hash;
use App\Models\UsersOFAll;
use App\Http\Controllers\Authsend;

class CodeAuth extends Component
{
    public $code;
    public $newcode;
    public $err;
    public function render()
    {
        return view('livewire.code-auth');
    }

    public function CheckAuth()
    {
        if ($this->newcode) {
            if(Hash::check($this->newcode,$this->code))
            {
              $userdata=session()->get('UAuth_not_auth');
              $u=UsersOFAll::find($userdata->id);
              $u->IsEmailAuth=1;
              $u->save();
              session()->put('UAuth',$u);
              return redirect()->intended('dashboard')->with('success', 'Logged in successfully!');
            }
            else
            {
                $this->err='رمز التحقق غير متطابق';
            }
        } else {
            $this->err='يجب ملاء الحقل';
        }
        
        
    }
    public function Resend()
    {
        $userdata=session()->get('UAuth_not_auth');
        $au=new Authsend();
        // dd($userdata->name);
        $code=$au->SendEmail($userdata->name,$userdata->email);
        session()->put('usercode',$code);
        $this->code=$code;
    }
}
