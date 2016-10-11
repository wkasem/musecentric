<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class mediaController extends Controller
{


   public function upload(Request $request)
   {

       $filesrc  = basename(request()->file('media')->store(auth()->user()->id ));
       $filename = pathinfo(request()->file('media')->getClientOriginalName() , PATHINFO_FILENAME);



     auth()->user()->media()->create([
        'media_src' => $filesrc,
        'media_name'=> $filename
     ]);

     return $filesrc;
   }

   public function delete(Request $request)
   {
      if($request->ajax()){

        auth()->user()->media()->delete([
           'media_src' => $request->filename
        ]);
        Storage::delete(auth()->user()->id .'/'. $request->filename);
      }
   }

   public function getMedia($id , $path = null , $file)
   {
        $path = ($path) ? "{$path}/" : "";

        $img = Storage::get($id.'/'.$path.$file);

        $ext = pathinfo($file , PATHINFO_EXTENSION);

        return response($img)
             ->header('Content-Type', "image/{$ext}");
   }
   public function getMusic($id , $file)
   {

        $music = Storage::get($id.'/'.$file);

        $ext = pathinfo($file , PATHINFO_EXTENSION);

        return response($music)
             ->header('Content-Type', "audio/{$ext}");
   }

}
