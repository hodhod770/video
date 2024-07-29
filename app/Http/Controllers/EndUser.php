<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videws;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EndUser extends Controller
{
    //

    public function Openv($id)
    {
        return view('openvideo',['id'=>$id]);
    }

    public function Openc($id)
    {
        return view('openchannl',['id'=>$id]);
    }

    public function Listchannel()
    {
        return view('listchannels');
    }

    public function VideoRun($f)
    {
        $filename=Videws::where('uname',$f)->first()->video;
        $path = storage_path('app/public/videos/' . $filename);
        // dd($path);
        if (!file_exists($path)) {
            abort(404);
        }

        $stream = function() use ($path) {
            $stream = fopen($path, 'r');
            fpassthru($stream);
            fclose($stream);
        };

        return new StreamedResponse($stream, 200, [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function Search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $results = Videws::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('summary', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('kayword', 'LIKE', "%{$query}%");
            })
            ->when($category != 0, function ($q) use ($category) {
                $q->where('type', $category);
            })
            ->get();
        return view('Search',['results'=>$results]);
    }

    
}
