<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Channel;
use App\Models\UsersOFAll;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UserDashbord extends Component
{
    use WithFileUploads;
    public $imageChanal;
    public $bgimageChanal;
    public $name;
    public $desc;
    public function render()
    {
        $d=Channel::Where('Userid',session()->get('UAuth')->id)->get();
        $user=UsersOFAll::find(session()->get('UAuth')->id);
        return view('livewire.user-dashbord',['channel'=>$d,'user'=>$user]);
    }

    public function AddChannel()
    {
        // dd($this->imageChanal);
        $originalFilename = $this->imageChanal->getClientOriginalName();
        $extension = $this->imageChanal->getClientOriginalExtension();
        $uniqueFilename = uniqid() . '.' . $extension;
        $path = $this->imageChanal->storeAs('public/photos', $uniqueFilename);

        $bgoriginalFilename = $this->bgimageChanal->getClientOriginalName();
        $extension = $this->bgimageChanal->getClientOriginalExtension();
        $bguniqueFilename = uniqid() . '.' . $extension;
        $path = $this->bgimageChanal->storeAs('public/photos', $bguniqueFilename);

        $d=new Channel();
        $d->image=$uniqueFilename;
        $d->bgimage=$bguniqueFilename;
        $d->name=$this->name;
        $uuid = (string) Str::uuid();
        $d->uname=$uuid;
        $d->desc=$this->desc;
        $d->Userid=session()->get('UAuth')->id;
        $d->save();
        $this->reset();
        
    }

}
