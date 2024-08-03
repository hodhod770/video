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
    public $texts='';
    public function render()
    {
        $query=$this->texts;
        // dd($this->pages);
        $ch=Channel::Where('IsActive',1)->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('uname', 'LIKE', "%{$query}%")
              ->orWhere('desc', 'LIKE', "%{$query}%");
        })->orderby('id','desc')->take($this->pages)->get();
        return view('livewire.listchannels',['channels'=>$ch]);
    }
    public function incr()
    {
        
        $this->pages=$this->pages+15; 
        // dd($this->pages);
    }
}
