<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Videws;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Dept;

class ChannelsManage extends Component
{
    use WithFileUploads;

    public $id;
    public $video;
    public $name;
    public $type;
    public $summary;
    public $desc;
    public $kayword;
    public $video_id;
    public $thumbnailUrl;
    public function render()
    {
        $depts=Dept::get();
        $d=Videws::Where('id_channal',$this->id)->get();
        return view('livewire.channels-manage',['datas'=>$d,'depts'=>$depts]);
    }
    
    public function Store()
    {
        
        $originalFilename = $this->video->getClientOriginalName();
        $extension = $this->video->getClientOriginalExtension();
        $uniqueFilename = uniqid() . '.' . $extension;
        $path = $this->video->storeAs('public/videos', $uniqueFilename);
        $v=new Videws();
        $v->name=$this->name;
        $v->type=$this->type;
        $v->video=$uniqueFilename;
        $uuid = (string) Str::uuid();
        $v->uname=$uuid;
        $v->summary=$this->summary;
        $v->description=$this->desc;
        $v->kayword=$this->kayword;
        $v->id_channal=$this->id;
        $v->save();
        // $this->generateThumbnail('videos/'.$uniqueFilename);
        // // dd($this->thumbnailUrl);
        // $this->saveThumbnail();
    }
    
    private function generateThumbnail($videoPath)
    {
        $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

        // Extract the frame using a placeholder image
        $this->thumbnailUrl = $thumbnailPath;
       
    }


    public function saveThumbnail()
    {
        // Normally, you would save the thumbnail in this method
        // For demonstration, we simulate saving the thumbnail
        // Replace this with actual saving logic

        // Example: Using Intervention Image to create a 
        $manager = new Image(new Driver());
        $image = $manager->make(public_path('storage/' . $this->thumbnailUrl))->encode('jpg');
        Storage::disk('public')->put($this->thumbnailUrl, $image);

        // Clear the video property and thumbnailUrl to reset the form
        $this->video = null;
        $this->thumbnailUrl = null;

        session()->flash('message', 'Thumbnail saved successfully!');
    }


    public function delete($id)
    {

        $d=Videws::find($id);
        $filePath = storage_path('app/public/videos/' . $d->video);
        unlink($filePath);
        $d->delete();
    }

    public function foredite($id)
    {
        $d=Videws::find($id);
        $this->name=$d->name;
        $this->summary=$d->summary;
        $this->desc=$d->description;
        $this->kayword=$d->kayword;
        $this->video_id=$d->id;
        $this->type=$d->type;
        
        
    }

    public function edite()
    {
        $d=Videws::find($this->video_id);
        $d->name=$this->name;
        $d->summary=$this->summary;
        $d->description=$this->desc;
        $d->kayword=$this->kayword;
        $d->type=$this->type;
        $d->save();
        $this->reset("name","summary","desc","kayword","type");
        
    }
}
