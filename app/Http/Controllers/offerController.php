<?php

namespace App\Http\Controllers;

use App\Gigs;
use App\User;
use App\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Offer as NotiOffer;
use App\Notifications\Decline;
use App\Notifications\Accept;
use App\Payments\fees;

class offerController extends Controller
{


   public function show($id)
   {
     $offer = Offer::find($id);

     if(!$offer){return redirect('/gigs');}

     return view('home.offer' , compact('offer'));
   }

   public function new(Request $request , fees $fee)
   {

    $fee->checkout($request);

     return redirect('/my-gigs');

   }


   public function decline(Offer $offer)
   {

     $offer = Offer::find($id);

     $user_id = Gigs::find($offer->gig_id)->user_id;

     User::find($user_id)->notify(new Decline(json_encode([
       'user_name' => auth()->user()->first_name,
       'user_id'   => auth()->user()->id
     ])));

    $offer->delete();

         return redirect('/my-classes');
   }

   public function accept($id)
   {
     $offer = Offer::find($id);

     $user_id = Gigs::find($offer->gig_id)->user_id;

     Gigs::find($offer->gig_id)->hire()->create([
        'user_id' => auth()->user()->id
     ]);

     User::find($user_id)->notify(new Accept(json_encode([
       'user_name' => auth()->user()->first_name,
       'user_id'   => auth()->user()->id
     ])));

     $offer->delete();

     return redirect('/my-classes');
   }


}
