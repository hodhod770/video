<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Videws;
use App\Models\Comment;
use App\Models\WhatUserFeel;
use App\Models\Participants;
use App\Models\Channel;
use App\Models\VideoWatchHistory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
class OpenVidew extends Component
{
    
    public $id;
    public $texts;

    protected $rules = [
        'texts' => 'required|min:3',
    ];

    protected $messages = [
        'texts.required' => 'يجب ملء الحقل.',
        'texts.min' => 'يجب ألا يقل الحقل عن ثلاثة أحرف.',
    ];

    public function render()
    {
        $v=Videws::where('uname',$this->id)->first();
        $user = session()->get('UAuth');

        if ($user) {
            // إذا كان المستخدم مسجل الدخول
            if (VideoWatchHistory::canRecordWatch($user->id, $v->id)) {
                VideoWatchHistory::create([
                    'user_id' => $user->id,
                    'video_id' => $v->id,
                    'watched_at' => Carbon::now(),
                ]);
                $v->watch_num++;
                $v->save();
                // احذف النتيجة المخزنة مؤقتًا بعد التسجيل
                Cache::forget("user_{$user->id}_video_{$v->id}_last_watch");
            }
        } else {
            // إذا كان المستخدم غير مسجل الدخول
            $sessionKey = "video_{$v->id}_last_watch";

            // تحقق من آخر مشاهدة مسجلة في الجلسة
            $lastWatchTime = $request->session()->get($sessionKey);

            if (!$lastWatchTime || Carbon::now()->diffInMinutes($lastWatchTime) > 10) {
                // إذا لم يكن هناك مشاهدة سابقة أو مر أكثر من 10 دقائق، سجل المشاهدة
                $request->session()->put($sessionKey, Carbon::now());
                $v->watch_num++;
                $v->save();
                // يمكنك تسجيل هذه المعلومات في قاعدة بيانات مخصصة إذا كنت تريد الاحتفاظ بها لاحقًا
            }
        }
        // dd(VideoWatchHistory::canRecordWatch($user->id??0, $this->id));
        
          

            // احذف النتيجة المخزنة مؤقتًا بعد التسجيل
          

        $feel=WhatUserFeel::where('id_v',$this->id)->where('id_user',session()->get('UAuth')->id??0)->first();
        
        $Part=Participants::where('id_c',$v->id_channal)->where('id_user',session()->get('UAuth')->id??0)->first();
        
        $likesv=Videws::where('type',$v->type)->orwhere('id_channal',$v->id_channal)->get();
        $comment=Comment::where('id_v',$this->id)->Orderby('id','desc')->get();
        return view('livewire.open-videw',['vi'=>$v,'likesv'=>$likesv,'comment'=>$comment,'feel'=>$feel,'Part'=>$Part]);
    }

    public function Sendcommet()
    {
        $validated = $this->validate();
        if(session('UAuth'))
        {
            $c=new Comment();
            $c->texts=$this->texts;
            $c->id_v=$this->id;
            $c->id_user=session()->get('UAuth')->id;
            $c->save();
            $this->reset('texts');
        }
        else
        {
            // dd('s');
            return redirect('userlogin');
        }
    }

    public function editefeel($feel)
    {
        if(session('UAuth'))
        {
            if($feel!=0&&$feel!=1&&$feel!=2)
            {
                // dd($feel);
                return;
            }
            $data=WhatUserFeel::where('id_v',$this->id)->where('id_user',session()->get('UAuth')->id)->first();
            // dd(session()->get('UAuth')->id);
            $oldfeel=$data->feel??0;
            if($data)
            {
    
                $data->feel=$feel;
                $data->save();
    
                
            }
            else
            {      
                $f=new WhatUserFeel();
                $f->feel=$feel;
                $f->id_v=$this->id;
                $f->id_user=session()->get('UAuth')->id;
                $f->save();         
            }
           
            if($data)
            {
                //اخذنا القيمة القديمة وسويناها للحماية من الاختراق عبر فحص العنصر و تغغي القيمة اذاالقيمة غير المسجلة ينفذ و اذا نفس المسلجلة ما ينفذ
                if ($oldfeel!=$feel) {
                    $v=Videws::where('uname',$data->id_v)->first();
                    //اذا عمل اعجاب يزيد واحد
                    if($data->feel==1)
                    {
                        

                            $v->like_num++;
                        
                    }//اذا عمل الغاء الاعجاب و هو اعجاب ينقص واذا لغاء السيئ ما ينقص
                    elseif($data->feel==0&&$oldfeel!=2)
                    {

                     $v->like_num--;
         
                    }
                    //اذا عمل سيئ وهو معجب ينقص عشان نبعد الاعجاب ويبقى على ما هوه
                    if($oldfeel==1&&$data->feel==2)
                    {

                     $v->like_num--;

                    }
                    $v->save();
                 }
            }
            else
            {
                //اذا اول مره يعمل اعجاب يزيد واحد
                if($feel==1)
                {
                    $v=Videws::where('uname',$this->id)->first();
                    $v->like_num++;
                    $v->save();


                }
            }
        }
        else
        {
            return redirect('userlogin');

        }
        
    }

    public function Participants()
    {
        if(session('UAuth'))
        {
            $chann=Videws::where('uname',$this->id)->first();
            $d=Participants::where('id_c',$chann->id_channal)->where('id_user',session()->get('UAuth')->id)->first();
            $ch=Channel::where('uname',$chann->id_channal)->first();
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
            $data->id_c=$chann->id_channal;
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
