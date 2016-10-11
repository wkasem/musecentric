<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Payments\Paypal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use Auth;

class homeController extends Controller
{


   public function index()
   {

     return view('home.index');
   }

   public function showSettings()
   {

     return view('home.settings');
   }

   public function feedback(Request $request)
   {

     if(Auth::check()){
       $request->name = auth()->user()->first_name;
       $request->email = auth()->user()->email;
     }

     Mail::to(config('app.email'))->send(new Feedback($request));

     return redirect()->back()->with('has-sent' , true);
   }

   public function showProfile($id)
   {
     $user = User::find($id);

    if(!$user){return redirect('/gigs');}

     $user->load(['type' , 'gigs', 'media' , 'teaches.enrolls' ]);

     $user->gigs = $user->gigs->map(function($gig){

       $gig->attachments = array_map(function($img) use ($gig){
                              return "/media/{$gig->user_id}/gigs/{$img}";
                           },$gig->attachments);

       $gig->date = Carbon::now()->diffInDays(Carbon::parse($gig->date));

       $gig->has_bid = $gig->bids->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

       return $gig;
     });

     $user->teaches = $user->teaches->map(function($teach){

       $teach->attachments = array_map(function($img) use ($teach){
                              return "media/{$teach->user_id}/gigs/{$img}";
                           },$teach->attachments);

       $teach->date = Carbon::now()->diffInDays(Carbon::parse($teach->date));

       $teach->has_enroll = $teach->enrolls->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

       return $teach;
     });

     $userConnects = auth()->user()->connects;

     $user->connects = $user->connects->map(function($connect) use($userConnects){

         $connect->has_connected = false;
         foreach ($userConnects as $key => $c) {

          if($c->connect_to == $connect->connect_to){
            $connect->has_connected = true;
          }
         }
      return $connect;
    });

     return view('home.profile' , compact('user'));
   }

   public function showNotifications()
   {
     auth()->user()->unreadNotifications->markAsRead();

     $notifications = auth()->user()->notifications->map(function($n){
       $r = explode("\\",$n->type);
       $n->type = $r[count($r) - 1];
       return $n;
     });

     return view('home.notifications',compact('notifications'));
   }

   public function subscribe(Paypal $paypal)
   {

     return $paypal->getCheckout();
   }

   public function userConnect(Request $request)
   {

     auth()->user()->connects()->create([
       'connect_to' => $request->id
     ]);
   }

   public function userUnconnect(Request $request)
   {

     auth()->user()->connects()->where('connect_to', $request->id)->delete();
   }

}
