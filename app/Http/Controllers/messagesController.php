<?php

namespace App\Http\Controllers;

use App\User;
use App\Messages;
use Carbon\Carbon;
use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class messagesController extends Controller
{


  public function showMessages($crr_id = null)
  {

    $conversations = auth()->user()->conversations();

    $conversations = $conversations->map(function($conversation){

      $conversation->messages->map(function($msg){
        $msg->time =$msg->created_at->format('l h:i A');
      });

      return $conversation;
    });

    return view('home.messages' , compact('conversations' , 'crr_id'));
  }

  public function addToConversation($id )
  {

    $conversation_id = null;
    
    if(auth()->user()->id != $id){


      $conversation = Conversation::where([
        'user_id' => auth()->user()->id,
        'other_id'=> $id
      ])->get();

      if($conversation->isEmpty() &&  User::find($id)){
        $conversation_id = md5(rand(100 , 100000));

        Conversation::create([
          'conversation_id' => $conversation_id,
          'user_id' => auth()->user()->id,
          'other_id'=> $id
        ]);

        Conversation::create([
          'conversation_id' => $conversation_id,
          'other_id' => auth()->user()->id,
          'user_id'=> $id
        ]);

      }

      if(!$conversation->isEmpty()){
        $conversation_id = $conversation->first()->conversation_id;
      }

    }

    return $this->showMessages($conversation_id);
  }


  public function newMsg(Request $request)
  {

    Messages::create([
        'conversation_id' => $request->id,
        'user_id' => auth()->user()->id,
        'message' => $request->msg
     ]);

    return ['conversation_id' => $request->id,
            'user_id' => auth()->user()->id,
            'message' => $request->msg,
            'time'     => Carbon::now()->format('l h:i A')
           ];
  }

}
