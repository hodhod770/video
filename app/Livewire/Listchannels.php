<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Channel;
// use Livewire\WithPagination;
// use Livewire\WithoutUrlPagination;

class Listchannels extends Component
{
    // use WithPagination,WithoutUrlPagination;
    public $pages=30;
    public function render()
    {
        // dd($this->pages);
        $ch=Channel::Where('IsActive',1)->orderby('id','desc')->take($this->pages)->get();
        return view('livewire.listchannels',['channels'=>$ch]);
    }
    public function incr()
    {
        
        $this->pages=$this->pages+15; 
        // dd($this->pages);
    }
}
