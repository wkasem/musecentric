<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class confirmController extends Controller
{


   public function index()
   {

     return view('confirm');
   }

   public function resend()
   {

     $code = str_replace('/' , '' , bcrypt(rand(50,1000)));

     Mail::to(auth()->user()->email)->send(new Confirmation($code));

     auth()->user()->update(['confirmation_code' => $code]);

     return redirect()->back();
   }


   public function confirm($code)
   {

     if(auth()->user()->confirmation_code == $code){

       auth()->user()->update(['confirmed' => 1]);

       return redirect('/home');
     }

     return redirect('/confirm');
   }

}
