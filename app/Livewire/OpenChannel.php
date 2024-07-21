<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Videws;
use App\Models\Channel;
use App\Models\Participants;

class OpenChannel extends Component
{
    public $id;

    public function render()
    {
        $ch=Channel::Where('uname',$this->id)->first();
        $v=Videws::where('id_channal',$ch->uname)->orderby('id','desc')->get();
        // dd($v);
        $Part=Participants::where('id_c',$ch->uname)->where('id_user',session()->get('UAuth')->id??0)->first();

        return view('livewire.open-channel',['ch'=>$ch,'video'=>$v,'Part'=>$Part]);
    }
    public function Participants()
    {
        if(session('UAuth'))
        {
            // $chann=Videws::where('uname',$this->id)->first();
            $d=Participants::where('id_c',$this->id)->where('id_user',session()->get('UAuth')->id)->first();
            $ch=Channel::where('uname',$this->id)->first();
            // dd($d);
            if($d)
            {

                $d->stute=!$d->stute;
                if ($d->stute) {
                    $ch->subscription++;
                }
                else
                {
                    $ch->subscription--;

                }
                $d->save();
            }
            else
            {
                $ch->subscription++;
                
                $data=new Participants();
                $data->id_c=$this->id;
                $data->id_user=session()->get('UAuth')->id;
                $data->save();
            }
            $ch->save();

        }
        else
        {
            return redirect('userlogin');

        }

        

    }
}
