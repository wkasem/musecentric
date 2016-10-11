<?php

namespace App\Http\Controllers;

use DB;
use App\Bid;
use App\Gigs;
use App\Hire;
use App\User;
use App\Teach;
use Carbon\Carbon;
use App\Notifications\haveHired;
use App\Notifications\Bid as NotiBid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class gigController extends Controller
{


   public function gigsShow()
   {
     $gigs = Gigs::with('bids')->orderBy('created_at' , 'DESC')->paginate(1);

    $gigs->map(function($gig){

      $gig->attachments = array_map(function($img) use ($gig){
                             return "media/{$gig->user_id}/gigs/{$img}";
                          },$gig->attachments);

      $gig->date = Carbon::now()->diffInDays(Carbon::parse($gig->date));

      $gig->has_bid = $gig->bids->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

      return $gig;
    });


     $teaches = Teach::with('enrolls')->orderBy('created_at' , 'DESC')->paginate(1);

    $teaches->map(function($teach){

      $teach->attachments = array_map(function($img) use ($teach){
                             return "media/{$teach->user_id}/gigs/{$img}";
                          },$teach->attachments);
      $teach->date = Carbon::now()->diffInDays(Carbon::parse($teach->date));

      $teach->has_enroll = $teach->enrolls->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

      return $teach;
    });


     return view('home.gigs' , compact('gigs' , 'teaches'));
   }

   public function gigsMore()
   {

     $gigs = Gigs::with('bids')->orderBy('created_at' , 'DESC')->paginate(1);

    $gigs->map(function($gig){

      $gig->attachments = array_map(function($img) use ($gig){
                             return "media/{$gig->user_id}/gigs/{$img}";
                          },$gig->attachments);

      $gig->date = Carbon::now()->diffInDays(Carbon::parse($gig->date));

      $gig->has_bid = $gig->bids->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

      return $gig;
    });

     return $gigs;
   }


   public function newgigShow()
   {
     if(auth()->user()->subscribed == 0){ return redirect('/gigs');}
     return view('home.newgig');
   }

   public function newgig(Request $request)
   {

     $this->validate($request, [
         'title' => 'required',
         'requirements' => 'required',
         'summary' => 'required',
         'date' => 'required',
         'location' => 'required',
         'budget' => 'required|numeric',
     ]);

    DB::transaction(function() use ($request){

        $srcsArray = [];
        $namesArray = [];

        if($request->attachments){
          //first upload attachments if there are any
          foreach($request->attachments as $file){
              $attachsArray[] = basename($file->store( auth()->user()->id .'/gigs'));
          }
        }

        //save to DB

        Gigs::create([
           'user_id' => auth()->user()->id,
           'title'   => $request->title,
           'requirements' => $request->requirements,
           'summary' => $request->summary,
           'attachments' => $attachsArray,
           'date' => $request->date,
           'location' => $request->location,
           'budget'  => $request->budget
        ]);
    });

    return redirect('/my-gigs')->with('new-gig' , true);
   }


   public function mygigsShow()
   {

     $gigs = Gigs::with(['bids' , 'hire', 'offer'])->where('user_id' , auth()->user()->id)
                   ->orderBy('created_at' , 'DESC')->get();

     $teaches = Teach::with('enrolls')->where('user_id' , auth()->user()->id)
                   ->orderBy('created_at' , 'DESC')->get();

     $contracts = Hire::with('gig')->where('user_id' , auth()->user()->id)
                   ->orderBy('created_at' , 'DESC')->get();

     return view('home.mygig' , compact('gigs' , 'teaches' , 'contracts'));
   }
   public function myclassesShow()
   {

     $teaches = Teach::with('enrolls')->where('user_id' , auth()->user()->id)
                   ->orderBy('created_at' , 'DESC')->get();
     $contracts = Hire::with('gig')->where('user_id' , auth()->user()->id)
                   ->orderBy('created_at' , 'DESC')->get();

     return view('home.mygig' , compact('teaches' , 'contracts'));
   }

   public function gigShow($id)
   {
      $gig = Gigs::find($id);

      if(!$gig){return redirect('/gigs');}
       $gig->attachments = array_map(function($img) use ($gig){
                              return "media/{$gig->user_id}/gigs/{$img}";
                           },$gig->attachments);

       $gig->date = Carbon::now()->diffInDays(Carbon::parse($gig->date));

     return view('home.gigShow' , compact('gig'));
   }

   public function gigBid(Request $request , $id)
   {

     $data = $request->data;
     $send = [];

     foreach ($data as $arr) {
       $send[$arr['name']] = $arr['value'];
     }

     $send['user_id'] = auth()->user()->id;

     User::find($request->gig['owner_id'])->notify(new NotiBid(json_encode([
       'user_name' => auth()->user()->first_name,
       'gig_id'    => $id,
       'gig_title' => $request->gig['gig_title'],
       'budget'    => $send['budget'],
       'user_id'   => auth()->user()->id
     ])));

     Gigs::find($id)->bids()->create($send);
   }

   public function gigEdit(Request $request , $id)
   {

     $update = ['id' => $id];

     foreach ($request->data as $data) {
       if($data['name'] == 'requirements'){
         $update['requirements'][] = $data['value'];
       }else{
         $update[$data['name']] = $data['value'];
       }
     }

     Gigs::find($id)->update([
        'title'   => $update['title'],
        'requirements' => $update['requirements'],
        'summary' => $update['summary'],
        'date' => $update['date']
     ]);

     return $update;
   }


   public function gigHire(Request $request)
   {


   }

   public function gigHireAccept(Request $request)
   {

      Hire::find($request->id)->update(['accepted' => true]);
   }
   public function gigDelete($id)
   {


     Gigs::find($id)->delete();
   }

}
