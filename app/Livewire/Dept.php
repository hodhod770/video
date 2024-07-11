<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dept as DeptTable;
class Dept extends Component
{
    public $name;
    public $id;
    public $nameedite;
    public function render()
    {
        $d=DeptTable::get();
        return view('livewire.dept',['de'=>$d]);
    }
    public function Store()
    {
        $data=new DeptTable();
        $data->name=$this->name;
        $data->save();
        $this->reset();
    }
    public function Delete($id)
    {
        $data=DeptTable::find($id);  
        $data->delete();
    } 

    public function Senddata($id,$name)
    {
       $this->id=$id;
       $this->nameedite=$name;
    } 
    public function Edite()
    {
        $data=DeptTable::find($this->id);  
        $data->name=$this->nameedite;
        $data->save();
    }
}
