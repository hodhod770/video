<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Channel;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UserDashbord extends Component
{
    use WithFileUploads;
    public $imageChanal;
    public $name;
    public $desc;
    public function render()
    {
        $d=Channel::Where('Userid',session()->get('UAuth')->id)->get();
        return view('livewire.user-dashbord',['channel'=>$d]);
    }

    public function AddChannel()
    {
        $originalFilename = $this->imageChanal->getClientOriginalName();
        $extension = $this->imageChanal->getClientOriginalExtension();
        $uniqueFilename = uniqid() . '.' . $extension;
        $path = $this->imageChanal->storeAs('public/photos', $uniqueFilename);
        $d=new Channel();
        $d->image=$uniqueFilename;
        $d->name=$this->name;
        $uuid = (string) Str::uuid();
        $d->uname=$uuid;
        $d->desc=$this->desc;
        $d->Userid=session()->get('UAuth')->id;
        $d->save();
        $this->reset();
        
    }

}
